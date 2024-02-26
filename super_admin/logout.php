<?php
// In super_admin_panel.php
session_start();
if (isset($_SESSION['super_admin'])) {
    unset($_SESSION['super_admin']);
}
header('Location: index.html');
exit();
?>
