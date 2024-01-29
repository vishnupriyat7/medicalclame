<?php
session_start();
// Delete certain session
unset($_SESSION['SESSION_EMAIL']);
// Delete all session variables
session_destroy();
echo "<script>window.location = 'index.php'</script>";

?>
