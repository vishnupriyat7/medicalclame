<?php
ini_set('display_errors', '0'); 
include "header.php";
include "sidebar_publisher.php";
$user_id = $user['id'];
// var_dump($user_id);die;
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Profile</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li> -->
                                <!-- <li class="breadcrumb-item active">Add</li> -->
                                <a class="dropdown-item" href="logout.php"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <br><br>
            <div class="row">
                <!--end col-->
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <!-- <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                                <i class="fas fa-home"></i> New Blog
                                            </a>
                                        </li>
                                    </ul>
                                </div> -->
                        <?php
                        $status = "OK";
                        $msg = "";
                        if ($user_id) {
                            $sql1 = "SELECT * FROM users_profile WHERE user_id = ?;";
                            $stmt1 = $con->prepare($sql1);
                            $stmt1->bind_param("s", $user_id);
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            $user_profile = $result1->fetch_assoc();
                            $comp_name = $user_profile['org_name'];
                            $estb_year = $user_profile['estb_year'];
                            $reg_no = $user_profile['reg_no'];
                            $gst_no = $user_profile['gst_no'];
                            $book_lang = $user_profile['book_lang'];
                            $title_no = $user_profile['title_no'];
                            $org_nature = $user_profile['org_nature'];
                            $mgr_pub_hse = $user_profile['mgr_house_name'];
                            $head_name = $user_profile['head_org_name'];
                            $head_addr = $user_profile['head_org_addr'];
                            $head_mobile = $user_profile['head_org_mobile'];
                            $head_email = $user_profile['head_org_email'];
                            $head_site = $user_profile['head_org_website'];
                            $prsn_name = $user_profile['cntct_prsn_name'];
                            $prsn_addr = $user_profile['cntct_prsn_addr'];
                            $prsn_mobile = $user_profile['cntct_prsn_mobile'];
                            $prsn_email = $user_profile['cntct_prsn_email'];
                            $whatsapp = $user_profile['cntct_prsn_watsapp'];
                            $fascia = $user_profile['fascia'];
                            $remark = $user_profile['remarks'];
                            $logo = base64_encode($user_profile['logo']);
                            if ($org_nature == 'A') {
                                $select0 = '';
                                $selecta = 'selected';
                                $selectp = '';
                            } else if ($org_nature == 'P') {
                                $select0 = '';
                                $selecta = '';
                                $selectp = 'selected';
                            } else {
                                $select0 = 'selected';
                                $selecta = '';
                                $selectp = '';
                            }
                            if (!$logo) {
                                $hide = "";
                            } else {
                                $hide = "hidden";
                            }
                            $sub_status = $user_profile['submitted'];
                            if ($sub_status == 0) {
                                $edit = '';
                            } else {
                                $edit = 'disabled';
                            }
                        } else {
                            $comp_name = '';
                            $estb_year = '';
                            $reg_no = '';
                            $gst_no = '';
                            $book_lang = '';
                            $title_no = '';
                            $org_nature = '';
                            $mgr_pub_hse = '';
                            $head_name = '';
                            $head_addr = '';
                            $head_mobile = '';
                            $head_email = '';
                            $head_site = '';
                            $prsn_name = '';
                            $prsn_addr = '';
                            $prsn_mobile = '';
                            $prsn_email = '';
                            $whatsapp = '';
                            $fascia = '';
                            $remark = '';
                        }
                        // if (isset($_POST['submit-form'])) {
                        //     $query = "UPDATE users_profile SET submitted = 1 WHERE user_id = '$user_id'";
                        //     $resultSub = mysqli_query($con, $query);
                        //     if ($resultSub) {
                        //         $errormsg = "
                        //   <div class='alert alert-success alert-dismissible alert-outline fade show'>
                        //                     Your Profile Details is Successfully Submitted. Further edit is not possible.
                        //                     <button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button>
                        //                     </div>
                                          
                        //    ";
                        //     } else {
                        //         $errormsg = "
                        //             <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                        //                        Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help.
                        //                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        //                        </div>";
                        //     }
                        // }
                        if (isset($_POST['save'])) {
                            $comp_name =
                                mysqli_real_escape_string($con, $_POST['comp_name']);
                            $estb_year =
                                mysqli_real_escape_string($con, $_POST['estb_year']);
                            $reg_no =
                                mysqli_real_escape_string($con, $_POST['reg_no']);
                            $gst_no =
                                mysqli_real_escape_string($con, $_POST['gst_no']);
                            $book_lang =
                                mysqli_real_escape_string($con, $_POST['book_lang']);
                            $title_no =
                                mysqli_real_escape_string($con, $_POST['title_no']);
                            $org_nature =
                                mysqli_real_escape_string($con, $_POST['org_nature']);
                            $mgr_pub_hse =
                                mysqli_real_escape_string($con, $_POST['mjr_pub_val']);
                            $head_name =
                                mysqli_real_escape_string($con, $_POST['head_name']);
                            $head_addr =
                                mysqli_real_escape_string($con, $_POST['head_addr']);
                            $head_mobile =
                                mysqli_real_escape_string($con, $_POST['head_mobile']);
                            $head_email =
                                mysqli_real_escape_string($con, $_POST['head_email']);
                            $head_site =
                                mysqli_real_escape_string($con, $_POST['head_site']);
                            $prsn_name =
                                mysqli_real_escape_string($con, $_POST['prsn_name']);
                            $prsn_addr =
                                mysqli_real_escape_string($con, $_POST['prsn_addr']);
                            $prsn_mobile =
                                mysqli_real_escape_string($con, $_POST['prsn_mobile']);
                            $prsn_email =
                                mysqli_real_escape_string($con, $_POST['prsn_email']);
                            $whatsapp =
                                mysqli_real_escape_string($con, $_POST['whatsapp']);
                            $fascia =
                                mysqli_real_escape_string($con, $_POST['fascia']);
                            $remark =
                                mysqli_real_escape_string($con, $_POST['remark']);
                            $current_date = new DateTime();
                            $date = date_format($current_date, "Y-m-d H:i:s");
                            if (!empty($_FILES["logo"]["name"])) {
                                // Get file info 
                                $fileName = basename($_FILES["logo"]["name"]);
                                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                                // Allow certain file formats 
                                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                                if (in_array($fileType, $allowTypes)) {
                                    $image = $_FILES['logo']['tmp_name'];
                                    $imgContent = addslashes(file_get_contents($image));
                                } else {
                                    $msg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                                    $status = "NOTOK";
                                }
                            } else {
                                if (!$logo) {
                                    $msg = 'Please select an image file to upload.';
                                    $status = "NOTOK";
                                }
                                // }
                            }
                            if (strlen($comp_name) < 3) {
                                $msg = $msg . "Organisation name must be more than 3 characters length.<BR>";
                                $status = "NOTOK";
                            }
                            if (strlen($head_name) < 3) {
                                $msg = $msg . "Name must be more than 3 characters length.<BR>";
                                $status = "NOTOK";
                            }
                            if (strlen($head_mobile) < 10) {
                                $msg = $msg . "Phone No. should be 10 digits.<BR>";
                                $status = "NOTOK";
                            }
                            if (strlen($head_email) < 3) {
                                $msg = $msg . "Email must be more than 3 characters length.<BR>";
                                $status = "NOTOK";
                            }
                            if (strlen($head_site) < 5) {
                                $msg = $msg . "Website address should be more than 5 characters length.<BR>";
                                $status = "NOTOK";
                            }
                            if (strlen($prsn_name) < 3) {
                                $msg = $msg . "Contact person name must be more than 3 char length.<BR>";
                                $status = "NOTOK";
                            }
                            if (strlen($prsn_mobile) < 10) {
                                $msg = $msg . "Contact person phone No. should 10 digits.<BR>";
                                $status = "NOTOK";
                            }
                            if (strlen($prsn_email) < 3) {
                                $msg = $msg . "Contact person email must be more than 3 characters length.<BR>";
                                $status = "NOTOK";
                            }
                            if (strlen($whatsapp) < 10) {
                                $msg = $msg . "WhatsApp No. should be 10 digits.<BR>";
                                $status = "NOTOK";
                            }
                            if (strlen($book_lang) < 3) {
                                $msg = $msg . "Please mention language(s) in which books are published.<BR>";
                                $status = "NOTOK";
                            }
                            $errormsg = "";
                            if ($status == "NOTOK") {
                                $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>" .
                                    $msg . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                               </div>"; //printing error if found in validation
                            } else {
                                if ($user_id && $user_profile['id']) {
                                    if ((!$imgContent) && $logo) {
                                        $query = "UPDATE users_profile SET org_name = '$comp_name', estb_year = '$estb_year', reg_no = '$reg_no', gst_no = '$gst_no', book_lang = '$book_lang', title_no = '$title_no', org_nature = '$org_nature', mgr_house_name = '$mgr_pub_hse', head_org_name = '$head_name', head_org_addr = '$head_addr', head_org_mobile = '$head_mobile', head_org_email = '$head_email', head_org_website = '$head_site', cntct_prsn_name = '$prsn_name', cntct_prsn_addr = '$prsn_addr', cntct_prsn_mobile = '$prsn_mobile', cntct_prsn_email = '$prsn_email', cntct_prsn_watsapp = '$whatsapp', status = 'E', updated_at = '$date', fascia = '$fascia', remarks = '$remark' WHERE user_id = '$user_id'";
                                    } else {
                                    $query = "UPDATE users_profile SET org_name = '$comp_name', estb_year = '$estb_year', reg_no = '$reg_no', gst_no = '$gst_no', book_lang = '$book_lang', title_no = '$title_no', org_nature = '$org_nature', mgr_house_name = '$mgr_pub_hse', head_org_name = '$head_name', head_org_addr = '$head_addr', head_org_mobile = '$head_mobile', head_org_email = '$head_email', head_org_website = '$head_site', cntct_prsn_name = '$prsn_name', cntct_prsn_addr = '$prsn_addr', cntct_prsn_mobile = '$prsn_mobile', cntct_prsn_email = '$prsn_email', cntct_prsn_watsapp = '$whatsapp', status = 'E', updated_at = '$date', fascia = '$fascia', remarks = '$remark', logo = '$imgContent' WHERE user_id = '$user_id'";
                                    }
                                } else {
                                    $query = "INSERT INTO users_profile (org_name, estb_year, reg_no, gst_no, book_lang, title_no, org_nature, mgr_house_name, head_org_name, head_org_addr, head_org_mobile, head_org_email, head_org_website, cntct_prsn_name, cntct_prsn_addr, cntct_prsn_mobile, cntct_prsn_email, cntct_prsn_watsapp, status, updated_at, fascia, remarks, user_id, logo) VALUES ('$comp_name', '$estb_year', '$reg_no', '$gst_no', '$book_lang', '$title_no', '$org_nature', '$mgr_pub_hse', '$head_name', '$head_addr', '$head_mobile', '$head_email', '$head_site', '$prsn_name', '$prsn_addr', '$prsn_mobile', '$prsn_email', '$whatsapp', 'E', '$date', '$fascia', '$remark', '$user_id', '$imgContent')";
                                }
                                $result = mysqli_query($con, $query);
                                if ($result) {
                                    $errormsg = "
                              <div class='alert alert-success alert-dismissible alert-outline fade show'>
                                                Your Profile Details is Successfully Saved. Proceed with stall(s) booking.
                                                <button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button>
                                                </div>
                                              
                               ";
                                    $sql1 = "SELECT * FROM users_profile WHERE user_id = ?;";
                                    $stmt1 = $con->prepare($sql1);
                                    $stmt1->bind_param("s", $user_id);
                                    $stmt1->execute();
                                    $result1 = $stmt1->get_result();
                                    $user_profile = $result1->fetch_assoc();
                                    $comp_name = $user_profile['org_name'];
                                    $estb_year = $user_profile['estb_year'];
                                    $reg_no = $user_profile['reg_no'];
                                    $gst_no = $user_profile['gst_no'];
                                    $book_lang = $user_profile['book_lang'];
                                    $title_no = $user_profile['title_no'];
                                    $org_nature = $user_profile['org_nature'];
                                    $mgr_pub_hse = $user_profile['mgr_house_name'];
                                    $head_name = $user_profile['head_org_name'];
                                    $head_addr = $user_profile['head_org_addr'];
                                    $head_mobile = $user_profile['head_org_mobile'];
                                    $head_email = $user_profile['head_org_email'];
                                    $head_site = $user_profile['head_org_website'];
                                    $prsn_name = $user_profile['cntct_prsn_name'];
                                    $prsn_addr = $user_profile['cntct_prsn_addr'];
                                    $prsn_mobile = $user_profile['cntct_prsn_mobile'];
                                    $prsn_email = $user_profile['cntct_prsn_email'];
                                    $whatsapp = $user_profile['cntct_prsn_watsapp'];
                                    $fascia = $user_profile['fascia'];
                                    $remark = $user_profile['remarks'];
                                    $logo = base64_encode($user_profile['logo']);
                                    if ($org_nature == 'A') {
                                        $select0 = '';
                                        $selecta = 'selected';
                                        $selectp = '';
                                    } else if ($org_nature == 'P') {
                                        $select0 = '';
                                        $selecta = '';
                                        $selectp = 'selected';
                                    } else {
                                        $select0 = 'selected';
                                        $selecta = '';
                                        $selectp = '';
                                    }
                                    if (!$logo) {
                                        $hide = "";
                                    } else {
                                        $hide = "hidden";
                                    }
                                }  else {
                                    $errormsg = "
                                    <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                               Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help.
                                               <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                               </div>";
                                }
                            }
                        }
                        ?>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <?php
                                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                        print $errormsg;
                                    }
                                    ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row bg-grey">
                                            <div class="form-group col-12"></div>
                                            <div class="form-group col-12">
                                                <label><b>Publishing House / Organization</b></label>
                                            </div>
                                            <div class="form-group col-8">
                                            *Name
                                                <input type="text" class="form-control" name="comp_name" placeholder="*Name" id="comp_name" value="<?= $comp_name; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-4">
                                            *Year of Establishment
                                                <input type="text" class="form-control" name="estb_year" id="estb_year" placeholder="*Year of Establishment" required="required" value="<?= $estb_year; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-6">
                                            Register No.
                                                <input type="text" class="form-control" name="reg_no" id="reg_no" placeholder="Register No." value="<?= $reg_no; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-6">
                                            GST No.
                                                <input type="text" class="form-control" name="gst_no" id="gst_no" placeholder="GST No." value="<?= $gst_no; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-4">
                                            *No.of Titles Published
                                                <input type="number" class="form-control" name="title_no" id="title_no" placeholder="*No.of Titles Published" required="required" min="0" value="<?= $title_no; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-8">
                                            *Language(s) in which books are published
                                                <input type="text" class="form-control" name="book_lang" id="book_lang" placeholder="*Language(s) in which books are published" required="required" value="<?= $book_lang; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-12">
                                                <br>
                                                <label><b>Nature of Organization</b></label>
                                            </div>
                                            <div class="row col-12">
                                                <div class="form-group col-4">Select 
                                                    <select class="form-control form-group" name="org_nature" id="org_nature" required="required" onchange="enterPublisher();" style="height:35px;" <?= $edit; ?>>
                                                        <!-- <option value="0" <?= $select0; ?>>Select</option> -->
                                                        <option value="P" <?= $selectp; ?>>Publisher</option>
                                                        <option value="A" <?= $selecta; ?>>Publisher & Distributor</option>
                                                    </select>
                                                </div>
                                                <?php if($user_profile) {
                                                    $dispaly = "block" ; 
                                                } else {
                                                    $dispaly = "none";
                                                } ?>
                                                <div class="form-group col-8" id="mjr_pub_hse" style="display: <?= $dispaly; ?>">
                                                Mention the name of the major Publishing House(s) which are distributed
                                                    <input id="mjr_pub_val" class="form-control" name="mjr_pub_val" placeholder="Mention the name of the major Publishing House(s) which are distributed" value="<?= $mgr_pub_hse; ?>" <?= $edit; ?>>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                </br>
                                                <div>
                                                    <label><b>Head of the Publishing House / Organization</b></label>
                                                </div>
                                                <div class="form-group">
                                                *Name
                                                    <input type="text" class="form-control" name="head_name" id="head_name" placeholder="*Name" required="required" value="<?= $head_name; ?>" <?= $edit; ?>>
                                                </div>
                                                <div class="form-group">
                                                *Address
                                                    <textarea class="form-control" name="head_addr" id="head_addr" placeholder="*Address" required="required" <?= $edit; ?>><?= $head_addr; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                *Email
                                                    <input type="email" class="form-control" name="head_email" id="head_email" placeholder="*Email" required="required" value="<?= $head_email; ?>" <?= $edit; ?>>
                                                </div>
                                                <div class="form-group">
                                                *Website
                                                    <input type="text" class="form-control" name="head_site" id="head_site" placeholder="*Website" required="required" value="<?= $head_site; ?>" <?= $edit; ?>>
                                                </div>
                                                <div class="form-group">
                                                *Mobile
                                                    <input type="number" class="form-control" name="head_mobile" id="head_mobile" placeholder="*Mobile" required="required" min="0" value="<?= $head_mobile; ?>" <?= $edit; ?>>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                </br>
                                                <div>
                                                    <label><b>Single Point of Contact</b></label>
                                                    <input type="checkbox" name="same-check" id="same-check" onclick="sameCheck();" <?= $edit; ?>>
                                                    <label for="same-check"> Same as House</label>
                                                </div>
                                                <div class="form-group">
                                                *Name
                                                    <input type="text" class="form-control" name="prsn_name" id="prsn_name" placeholder="*Name" required="required" value="<?= $prsn_name; ?>" <?= $edit; ?>>
                                                </div>
                                                <div class="form-group">
                                                *Address
                                                    <textarea class="form-control" name="prsn_addr" id="prsn_addr" placeholder="*Address" required="required" <?= $edit; ?>><?= $prsn_addr; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                *Email
                                                    <input type="email" class="form-control" name="prsn_email" id="prsn_email" placeholder="*Email" required="required" value="<?= $prsn_email; ?>" <?= $edit; ?>>
                                                </div>
                                                <div class="form-group">
                                                *Mobile
                                                    <input type="number" class="form-control" name="prsn_mobile" id="prsn_mobile" placeholder="*Mobile" required="required" min="0" value="<?= $prsn_mobile; ?>" <?= $edit; ?>>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-8">
                                                    *WhatsApp No.
                                                        <input type="number" class="form-control" name="whatsapp" id="whatsapp" placeholder="*WhatsApp No." required="required" min="0" value="<?=  $whatsapp; ?>" <?= $edit; ?>>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="checkbox" name="same-mobile" id="same-mobile" onclick="sameCheckMob();" <?= $edit; ?>>
                                                        <label for="same-mobile">Same as mobile</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group col-12">
                                                <label><b>Choose your cubicle</b></label>
                                            </div>
                                            <div class="form-group col-12">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <input class="form-control font-weight-bold text-center" value="Size of Stall" disabled>
                                                    </div>
                                                    <div class="col-3">
                                                        <input class="form-control font-weight-bold text-center" value="Fare / Unit + 18% GST Extra (in ₹  )" disabled>
                                                    </div>
                                                    <div class="col-3">
                                                        <input class="form-control font-weight-bold text-center" value="No. Required " disabled>
                                                    </div>
                                                    <div class="col-3">
                                                        <input class="form-control font-weight-bold text-center" value="Total (in ₹  )" disabled>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <input class="form-control" value="3m X 3m" disabled>
                                                    </div>
                                                    <div class="col-3">
                                                        <input class="form-control text-right" value="10000" id="amt3x3" disabled>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control text-right" name="stall3x3" placeholder="00" id="stall3x3" onchange="amount();" value="<?= $stall3x3; ?>">
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control text-right" name="rate_amt" placeholder="00" id="rate_amt" disabled value="<?= $tot_amt3x3; ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <input class="form-control" value="3m X 2m" disabled>
                                                    </div>
                                                    <div class="col-3">
                                                        <input class="form-control text-right" value="7500" id="amt3x2" disabled>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control text-right" name="stall3x2" id="stall3x2" placeholder="00" onchange="amount();" value="<?= $stall3x2; ?>">
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control text-right" name="rate_amt3x2" id="rate_amt3x2" placeholder="00" disabled value="<?= $tot_amt3x2; ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-9">
                                                        <input class="form-control font-weight-bold text-right" value="Total amount payable (in ₹  )." disabled>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control text-right" name="totamt" id="totamt" placeholder="00" disabled value="<?= $total_amt; ?>">
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-6">
                                                </br>
                                                <label>*Please upload Logo of Publishing House / Organization<br>
                                                (Only JPG, JPEG, PNG files are allowed for uploads.)</label>
                                            </div>
                                            <div class="form-group col-6">
                                                </br>
                                                <input type="file" class="form-control" name="logo" id="logo" placeholder="*Upload Logo" <?= $hide; ?> <?= $edit; ?>>
                                                <label id="logo_lab">
                                                    <img src="data:image/jpg;charset=utf8;base64,<?= $logo; ?>" height="70vh" id="logo_img" <?= $edit; ?>>
                                                </label>
                                                <span id="changelogo" onclick="changeLogo();" <?= $edit; ?>><u>Change Logo</u></span>

                                                <!-- <input type="file" class="form-control" name="logo" id="logo" placeholder="*Upload Logo"> -->
                                            </div>
                                            <div class="form-group col-4">
                                                </br>
                                                *FASCIA / Display Text
                                                <input type="text" class="form-control" name="fascia" id="fascia" placeholder="*FASCIA / Display Text" required="required" value="<?= $fascia; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-8">
                                                </br>
                                                Remarks / Other information
                                                <input class="form-control" name="remark" id="remark" placeholder="Remarks / Other information" value="<?= $remark; ?>" <?= $edit; ?>>
                                            </div>
                                        </div><br>
                                        <!-- <div class="col-12">
                                            <button class="btn btn-bordered active btn-block mt-3" id="preview_btn" onclick="checkTerm();"><span class="text-white pr-3"><i class="fa fa-eye"></i></span>Preview</button>
                                            <button type="submit" class="btn btn-bordered active btn-block mt-3" name="save" id="save"><span class="text-white pr-3"><i class="fas fa-paper-plane"></i></span>Save</button>
                                        </div> -->
                                        <div class="col-lg-12">

                                            <button type="submit" name="save" class="btn btn-primary" id="save">Save</button>
                                            <!-- <?php if ($user_profile) { ?>
                                                <button type="submit" class="btn btn-success" name="submit-form" id="submit-form">Submit</button>
                                            <?php } ?> -->
                                            <!-- <span class="text-white pr-3"><i class="fas fa-paper-plane"></i></span> -->
                                        </div>
                                    </form>
                                </div>
                                <!--end tab-pane-->

                                <!--end tab-pane-->

                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>


        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?php include "footer.php"; ?>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;
        // document.getElementById("logo").addEventListener("change", function(event) {
        //     var file;
        //     const fsize = this.files[0].size;
        //     if (fsize > 1048576) {
        //         alert("File size too big, please select a file less than 2MB");
        //         return false;
        //     }

        // });

        function changeLogo() {
            $("#logo").removeAttr('hidden');
            $("#logo_img").remove();
        }

        function sameCheck() {
            var sameval = document.getElementById("same-check").checked;
            if (sameval === true) {
                $("#prsn_name").val($("#head_name").val());
                $("#prsn_addr").val($("#head_addr").val());
                $("#prsn_mobile").val($("#head_mobile").val());
                $("#prsn_email").val($("#head_email").val());
            } else {
                $("#prsn_name").val("");
                $("#prsn_addr").val("");
                $("#prsn_mobile").val("");
                $("#prsn_email").val("");
            }
        }

        function sameCheckMob() {
            var samemob = document.getElementById("same-mobile").checked;
            if (samemob === true) {
                $("#whatsapp").val($("#prsn_mobile").val());
            } else {
                $("#whatsapp").val("");
            }
        }

        function enterPublisher() {
            var orgNature = $("#org_nature").val();
            if (orgNature !== 'P') {
                $("#mjr_pub_hse").show();
            } else {
                $("#mjr_pub_hse").hide();
            }
        }

        function amount() {
            var amt3x3 = 10000;
            var stall_count3x3 = $("#stall3x3").val();
            tot_amt3x3 = (stall_count3x3 * amt3x3) + (amt3x3 * stall_count3x3 * 18) / 100;
            $("#rate_amt").val(tot_amt3x3);
            var amt3x2 = 7500;
            var stall_count3x2 = $("#stall3x2").val();
            tot_amt3x2 = (stall_count3x2 * amt3x2) + (amt3x2 * stall_count3x2 * 18) / 100;
            $("#rate_amt3x2").val(tot_amt3x2);
            var total_amt = tot_amt3x3 + tot_amt3x2;
            $("#totamt").val(total_amt);
        }

        // function checkTerm() {
        //     document.getElementById("terms").checked = false;
        //     document.getElementById("org_name_lab").innerHTML = $("#comp_name").val();
        //     document.getElementById("yers_lab").innerHTML = $("#estb_year").val();
        //     document.getElementById("reg_lab").innerHTML = $("#reg_no").val();
        //     document.getElementById("gst_lab").innerHTML = $("#gst_no").val();
        //     document.getElementById("lang_lab").innerHTML = $("#book_lang").val();
        //     document.getElementById("titl_lab").innerHTML = $("#title_no").val();
        //     document.getElementById("nature_new").innerHTML = "";
        //     var orgnature = $("#org_nature").val();
        //     if (orgnature === "P") {
        //         document.getElementById("natr_lab").innerHTML = "Publisher";
        //     } else if (orgnature === "A") {
        //         document.getElementById("natr_lab").innerHTML = "Publisher & Distributer";
        //         $('#preview-tab').find('#nature_new').append("<td><label>Major Publishing House(s) which are distributed</label></td><td colspan='2'><label>" + $('#mjr_pub_val').val() + "</label></td>");
        //     }
        //     document.getElementById("head_nam_lab").innerHTML = $("#head_name").val();
        //     document.getElementById("head_addr_lab").innerHTML = $("#head_addr").val();
        //     document.getElementById("head_mob_lab").innerHTML = $("#head_mobile").val();
        //     document.getElementById("head_email_lab").innerHTML = $("#head_email").val();
        //     document.getElementById("head_site_lab").innerHTML = $("#head_site").val();
        //     document.getElementById("prsn_nam_lab").innerHTML = $("#prsn_name").val();
        //     document.getElementById("prsn_addr_lab").innerHTML = $("#prsn_addr").val();
        //     document.getElementById("prsn_email_lab").innerHTML = $("#prsn_email").val();
        //     document.getElementById("prsn_mob_lab").innerHTML = $("#prsn_mobile").val();
        //     document.getElementById("prsn_wp_lab").innerHTML = $("#whatsapp").val();
        //     var stall3x3 = $("#stall3x3").val();
        //     var stall3x2 = $("#stall3x2").val();
        //     document.getElementById("3x3_lab").innerHTML = $("#stall3x3").val();
        //     document.getElementById("3x2_lab").innerHTML = $("#stall3x2").val();
        //     document.getElementById("3x2amt_lab").innerHTML = $("#amt3x2").val();
        //     document.getElementById("3x3amt_lab").innerHTML = $("#amt3x3").val();
        //     document.getElementById("fascia_lab").innerHTML = $("#fascia").val();
        //     document.getElementById("rmrk_lab").innerHTML = $("#remark").val();
        //     document.getElementById("logo_lab").innerHTML = $("#logo").val();
        //     $("#preview").modal({
        //         show: true
        //     });
        // }

        // document.getElementById("previewok").addEventListener("click", function(event) {
        //     event.preventDefault()
        //     var terms = document.getElementById("terms").checked;
        //     if (terms !== true) {
        //         alert("Please accept terms and conditions");
        //     } else {
        //         $("#preview-modal").modal('hide');
        //         $("#register").click();
        //     }
        // });

        $("#download").live("click", function() {
            var printWindow = window.open('', '', 'height=800,width=600');
            printWindow.document.write('<html><head><title>');
            printWindow.document.write('</title></head><body align="center">');
            printWindow.document.write('<img src="');
            printWindow.document.write('./assets/img/logo/header2.jpg');
            printWindow.document.write('" height="150" width="100%">');
            printWindow.document.write("<br><br><br><div align='center'>");
            printWindow.document.write("<table border='3'>");
            printWindow.document.write('<thead></thead><tbody><tr><th colspan="2">House / Organization</th></tr><tr><td>Name  <td>');
            printWindow.document.write($("#comp_name").val());
            printWindow.document.write('</td></tr><tr><td>Year of Establishment  </td><td>');
            printWindow.document.write($("#estb_year").val());
            printWindow.document.write('</td></tr><tr><td>Registration Number  </td><td>');
            printWindow.document.write($("#reg_no").val());
            printWindow.document.write('</td></tr><tr><td>GST Number  </td><td>');
            printWindow.document.write($("#gst_no").val());
            printWindow.document.write('</td></tr><tr><td>Language(s) in which books are published  </td><td>');
            printWindow.document.write($("#book_lang").val());
            printWindow.document.write('</td></tr><tr><td>Number of Titles Published  </td><td>');
            printWindow.document.write($("#title_no").val());
            printWindow.document.write('</td></tr><tr><td>Nature of Organization  </td><td>');
            var org_nature = $("#org_nature").val();
            if (org_nature == 'P') {
                printWindow.document.write('Publisher');
            } else {
                printWindow.document.write('Publisher & Distributer</td></tr><tr><td>Major Publishing House(s) which are distributed  </td><td>');
                printWindow.document.write($("#mjr_pub_val").val());
            }
            printWindow.document.write('</td></tr><tr><th colspan="2">Head of the Publishing House / Organization</th></tr><tr><td>Name  </td><td>');
            printWindow.document.write($("#head_name").val());
            printWindow.document.write('</td></tr><tr><td>Address  </td><td>');
            printWindow.document.write($("#head_addr").val());
            printWindow.document.write('</td></tr><tr><td>Email ID  </td><td>');
            printWindow.document.write($("#head_email").val());
            printWindow.document.write('</td></tr><tr><td>Website  </td><td>');
            printWindow.document.write($("#head_site").val());
            printWindow.document.write('</td></tr><tr><td>Mobile Number  </td><td>');
            printWindow.document.write($("#head_mobile").val());
            printWindow.document.write('</td></tr><tr><th colspan="2">Contact (In-charge) Person for the Fair</th></tr><tr><td>Name  </td><td>');
            printWindow.document.write($("#prsn_name").val());
            printWindow.document.write('</td></tr><tr><td>Address  </td><td>');
            printWindow.document.write($("#prsn_addr").val());
            printWindow.document.write('</td></tr><tr><td>Email ID  </td><td>');
            printWindow.document.write($("#prsn_email").val());
            printWindow.document.write('</td></tr><tr><td>Mobile Number  </td><td>');
            printWindow.document.write($("#prsn_mobile").val());
            printWindow.document.write('</td></tr><tr><td>WhatsApp Number  </td><td>');
            printWindow.document.write($("#whatsapp").val());
            printWindow.document.write('</td></tr><tr><td>Estimated amount to remit (including GST)</td><td>');
            printWindow.document.write('₹.');
            printWindow.document.write($("#totamt").val());
            printWindow.document.write('/-</td></tr><tr><td>FASCIA Text  </td><td>');
            printWindow.document.write($("#fascia").val());
            printWindow.document.write('</td></tr><tr><td>Remarks  </td><td>');
            printWindow.document.write($("#remark").val());
            printWindow.document.write('</td></tr><tr><td>Logo  </td><td>');
            const [file] = logo.files
            if (file) {
                printWindow.document.write('<img id = "blah" height="50px" width="100px" src = "');
                printWindow.document.write(URL.createObjectURL(file));
                printWindow.document.write('" alt = "your image " />');
            }
            printWindow.document.write('<img src="');
            printWindow.document.write('">');
            printWindow.document.write('</tr></tr></tbody></table>');
            printWindow.document.write("</div>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
        });
    </script>