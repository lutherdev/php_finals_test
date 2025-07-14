<?php
require_once BASE_PATH . '/bootstrap.php'; 
require_once UTILS_PATH . '/validators.util.php';
require_once UTILS_PATH . '/auth.util.php';
global $pdo;

Auth::init();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentUsername = $_SESSION['user']['username'];
    $inpUsername = trim($_POST['username']);
    $inpfirstName = trim($_POST['first_name']);
    $inplastName = trim($_POST['last_name']);
    $inpcity = trim($_POST['city']);
    $inpprovince = trim($_POST['province']);
    $inpstreet = trim($_POST['street']);

    if ($inpUsername !== '' && $inpfirstName !== '' && $inplastName !== '' && $inpcity !== '' && $inpprovince !== '' && $inpstreet !== '') {
        if (($usernameError = validateUsername($inpUsername)) !== true) {
            header('Location: /edit-profile?error='.$usernameError);
            exit;
        }
        try {
            $stmt = $pdo->prepare("
                UPDATE users SET 
                    username = :Username,
                    first_name = :firstName,
                    last_name = :lastName,
                    city = :city,
                    province = :province,
                    street = :street
                WHERE username = :currentUsername
            ");
            $stmt->execute([
                ':Username' => $inpUsername,
                ':firstName' => $inpfirstName,
                ':lastName' => $inplastName,
                ':city' => $inpcity,
                ':province' => $inpprovince,
                ':street' => $inpstreet,
                ':currentUsername' => $currentUsername
            ]);
            $_SESSION['user']['username'] = $inpUsername;
            header('Location: /profile-page');
            exit;
        } catch (PDOException $e) {
            header('Location: /edit-profile?error=PDO+Failed');
            exit;
        }
    } else {
        header('Location: /edit-profile?error=No+Empty+Fields');
        exit;
    }
} else {
    header('Location: /edit-profile?error=Request+Failed');
    exit;
}
