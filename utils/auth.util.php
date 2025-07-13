<?php
require_once 'validators.util.php';
class Auth{
    public static function init(): void {
    if (session_status() === PHP_SESSION_NONE) { //IF SESSION IS NONE : LIKE NO STARTED SESSION THEN =
        session_start(); // START THE SESSION NOW!
        if (headers_sent($file, $line)) {
            error_log("⚠️ Headers already sent in $file on line $line");
            }   
        } 
    }   
    //FOR LOGGIN IN
    public static function sessionSet(array $user): void{
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
        ]; 
    }

    //TODO: CREATE A TRY CATCH FUNCTION FOR FETCHING A ROW, ALSO A DEBUG IF WE GOT A ROW? AND A PASSWWORD VERIFY
    public static function attempt(PDO $pdo, string $username, string $password): string {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                return 'wrong_username';
            }
            if (!password_verify($password, $user['password'])) {
                return 'wrong_password';
            }
            self::sessionSet($user);
            return 'login_success';
        } catch (PDOException $e) {
            error_log("Auth attempt failed: " . $e->getMessage());
            return 'db_error';
        }
    }

    public static function register(PDO $pdo, array $data): string {
        $username = trim($data['username']);
        $password = $data['password'];
        $firstname = trim($data['firstname']);
        $lastname = trim($data['lastname']);
        //$role = trim($data['role']); REMOVE AUTOMATIC CUSTOMER
        $street = 'p campa'; //stays  the same
        $city = 'Nicanor'; //also small caps
        $province = 'Metro Manila'; //should be turn to small caps but if output it should be first letter of first word capital
        $wallet = floatval($data['wallet']);

        if (($usernameError = validateUsername($username)) !== true) {
            return $usernameError;
        }

        if (($passwordError = validatePassword($password)) !== true) {
            return $passwordError;
        }

        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
                INSERT INTO users (username, password, first_name, last_name, street, city, province, wallet)
                VALUES (:username, :password, :firstname, :lastname, :street, :city, :prov, :wallet)
            ");

            $stmt->execute([
                ':username' => $username,
                ':password' => $hashedPassword,
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':street' => $street,
                ':city' => $city,
                ':prov' => $province,
                ':wallet' => $wallet
            ]);

            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            self::sessionSet($user);
            return 'success';

        } catch (PDOException $e) {
            error_log("Registration failed: " . $e->getMessage());
            return 'db_error';
        }
    }

    public static function logout(): void
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }

    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function getData(PDO $pdo, string $username){
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user){
            return 'no_username';
        }
        self::sessionSet($user);
        return $user;
    }

    public static function topUpWallet($pdo, $userId, $amount) {
        $stmt = $pdo->prepare("UPDATE users SET wallet = wallet + ? WHERE id = ?");
        $stmt->execute([$amount, $userId]);

    }

    public static function checkUser($pdo, $username){
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user){
            return true;
        } else {
            return false;
        }
    }
}