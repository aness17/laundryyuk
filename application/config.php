<?

require_once 'vendor/autoload.php';

$google_client = new Google_Client();
$google_client->setClientId('980604333007-6rjetfmp9nmi1i5773ahov422spv1krf.apps.googleusercontent.com');

$google_client->setClientSecret('ouj9jIAYRy95VFOXe4AxlQWn');

$google_client->setRedirectUri('http://localhost/LaundryYuk/auth.php');

$google_client->addScope('email');

$google_client->addScope('profile');

session_start();

?>