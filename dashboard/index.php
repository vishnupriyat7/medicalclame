<?php
ini_set('display_errors', '0');
include "header.php";

$username = $_SESSION['SESSION_EMAIL'];

// $sql1 = "SELECT user FROM users WHERE email = ?;";
// $stmt1 = $con->prepare($sql1);
// $stmt1->bind_param("s", $username);
// $stmt1->execute();
// $result1 = $stmt1->get_result();
// $user = $result1->fetch_assoc();

// var_dump($user);die;
if ($user['user_type'] == 'S') {
    include "sidebar.php";
} elseif ($user['user_type'] == 'P') {
    include "publisher_sidebar.php";
} elseif ($user['user_type'] == 'PC') {
    include "pgmcmtee_sidebar.php";
} elseif ($user['user_type'] == 'FC') {
    include "finance_sidebar.php";
} elseif ($user['user_type'] == 'CC') {
    include "cultural_sidebar.php";
} elseif ($user['user_type'] == 'RC') {
    include "reception_sidebar.php";
} elseif ($user['user_type'] == 'SD') {
    include "sdf_sidebar.php";
}
?>



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <?php if ($user['user_type'] == 'S') {
    include "dashboard.php";
} elseif ($user['user_type'] == 'P') {
    include "publisher_dashboard.php";
} elseif ($user['user_type'] == 'PC') {
    include "pgmcmtee_dashboard.php";
} elseif ($user['user_type'] == 'FC') {
    include "finance_dashboard.php";
} elseif ($user['user_type'] == 'CC') {
    include "cultural_dashboard.php";
} elseif ($user['user_type'] == 'RC') {
    include "receptioncmtee_dashboard.php";
} elseif ($user['user_type'] == 'SD') {
    include "sdf_dashboard.php";
}?>

        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?php include "footer.php";?>