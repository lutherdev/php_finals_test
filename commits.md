HOME
ABOUT US
STORE
CONTACT US
ADMIN DASHBOARD
ACCOUNT


CJ
MAIN LAOUT
HEAD COMPONENT
NAVBAR COMPONENT
FOOTER COMPONENT
HOME
ABOUT US
ADMIN DASHBOARD

PING
TABLES (users, items, item_orders, messages, images) (database)
RESET, SEEDER, MIGRATE
 
ERROR PAGE (design)
CONTACT US (design)
LOGIN (design)
REGISTER (design)

ADMIN DASHBOARD (design)
PROFILE PAGE (design) collab with backend for session stuff and fetching data from database

RESET
SEEDER
MIGRATE

LUTHER
envSetter
UTILS DBINIT
STORE (APPLY CHECKOUT HANDLER AND AUTH UTIL)
CONTACT US (CONTACT HANDLER)
PROFILE


//////////////////////////////////
no success output for messages
You sent
username exist
You sent
money output for storage
You sent
indicator
after checkout, nasa profile view orders
You sent
input validation for edit item
pag A input sa quantity, dapat d mag success
You sent
success for delete user output
You sent
id item for remove
You sent
database fail when registering same user
You sent
hindi makarename
You sent
favicon
You sent
edit users for status change like admin












======================================================================







handlers==========
add-item
auth 		////
checkout	
contact		
edit item       ////(quantity stuff)(misdatatype)
edit profile	////
logout		
remove item     ////
remove user	////
role manager	////
store
top up		////

utils==============

page=========
remove item //
edit item footer
your orders footer

USERS - 
	- postgresql:seed /
	- register /
	- view users /
	- role manager /
	- delete users /

ITEMS - 
	- postgresql:seed /
	- add-item
	- view item
	- update item
	- delete item
IMAGES
	- add-item

USERS_MESSAGES
	- contact us

ITEM_ORDERS
	- store / checkout
	- 



strtolower() = everything lowercase

ucwords() = capitalize first letter of each word

ucfirst() = capitalize first letter of the string only


$success = $_GET['success'] ?? '';
$error = $_GET['error'] ?? '';

 <?php if (!empty($error)): ?>
          <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
          <p class="error"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>



PING COMMIT
database model
reset
seeder
migrate
