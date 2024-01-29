<?php include "header.php";
include "publisher_sidebar.php";
$user_id = $user['id'];
// var_dump($user_id );die;
?>
<style>
    .card {
        max-width: 100%;

    }

    .card table {

        border-collapse: collapse;
        border-spacing: 0;
        width: 70%;
        border: 1px solid #ddd;
        margin-left: 5%;
        margin-top: 4%;
        font-family: Arial, Helvetica, sans-serif;
        color: black;
    }

    #preview td,
    th {
        border: 1px solid #ddd;
        padding: 8px;
        width: 50%;
    }

    #preview th {
        text-align: center;
        /* font-size: xx-large; */
        color: black;
        /* font-weight: bold; */
    }


    #preview tr:nth-child(odd) {
        background-color: #f2f2f2;
    }

    #preview tr:hover {
        background-color: #ddd;
    }

    .td-head {
        text-align: center;
        font-size: medium;
        color: black;
        font-weight: bold;
    }

    .button {
        margin-top: 1%;
        text-align: start;
        margin-left: 6%;
        margin-bottom: 3%;

    }
</style>







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
                        <h4 class="mb-sm-0">Report</h4>
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


            <?php
            $status = "OK";
            $msg = "";
            if ($user_id) {
                // $sql1 = "SELECT * FROM users_profile WHERE user_id = ?; ";
                $sql1 =  "SELECT up.*, sb.*  FROM users_profile up JOIN stall_booking sb ON up.user_id = sb.user_id WHERE up.user_id = ?";
                // var_dump($sql1);
                $stmt1 = $con->prepare($sql1);

                $stmt1->bind_param("i", $user_id);
                // var_dump($stmt1);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                $user_profile = $result1->fetch_assoc();
                // var_dump($user_profile);
                if ($user_profile) {
                    $klaid = $user_profile['id'];
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
                    $stall3x3 = $user_profile['stalls_3x3'];
                    $stall3x2 = $user_profile['stalls_3x2'];
                    $fascia = $user_profile['fascia'];
                    $remark = $user_profile['remarks'];
                    $logo = base64_encode($user_profile['logo']);
                    $alloted_stall3x3 = $user_profile['confirm_3X3'];
                    $alloted_stall3x2 = $user_profile['confirm_3X2'];
                    $amt3x3 = 10000;
                    $tot_amt3x3 = ($alloted_stall3x3 * $amt3x3) + ($amt3x3 * $alloted_stall3x3 * 18) / 100;
                    $amt3x2 = 7500;
                    $tot_amt3x2 = ($allotted_stall3x2 * $amt3x2) + ($amt3x2 * $allotted_stall3x2 * 18) / 100;
                    $total_amt = $tot_amt3x3 + $tot_amt3x2;
                    $prof_reg_date = $user_profile['updated_at'];
                    $stall_reg_date = $user_profile['updated_date'];
                    if ($org_nature == 'A') {
                        $name_org = 'Publisher and Distributer';
                    } else if ($org_nature == 'P') {
                        $name_org = 'Publisher';
                    }
                } else {
                    $tot_amt3x3 = $tot_amt3x2 = $total_amt = 0;
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
                    $stall3x3 = 0;
                    $stall3x2 = 0;
                    $fascia = '';
                    $remark = '';
                }
            }
            ?>


            <div class="row">
                <div class="col-xxl-12 mt-0">
                    <!-- Terms-Condition Start-->
                    <div class="card">
                        <form>
                            <table id="preview">
                                <tr>
                                    <td class="td-head" colspan="2">
                                        <label><img src="assets/images/Logo_01.png" height="70vh" class="text-left"></label>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-head">
                                        <!-- <label><img src="assets/images/Logo_01.png" height="70vh"></label> -->
                                        <label>
                                            <h3><b>STALL BOOKING REPORT</b></h3>
                                        </label>
                                    </td>
                                <!-- </tr>
                                <tr> -->
                                    <td class="td-head" colspan="2">
                                        <?php if ($klaid > 99) { ?>
                                            <label>
                                                <h5><b>KLA-IBF00<?= $klaid; ?></h5></b>
                                            </label>
                                        <?php } else { ?>
                                            <label>
                                                <h5><b>KLA-IBF000<?= $klaid; ?></h5></b>
                                            </label>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-head" colspan="2">
                                        <label>
                                            <h5><b>Publishing House / Organization</h5></b>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Name:</label>
                                    </td>
                                    <td>
                                        <label id="org_name_lab"><?= $comp_name; ?></label>
                                        <input type="text" id="org_name_prv" hidden>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Year of Establishment</label>
                                    </td>
                                    <td>
                                        <label id="yers_lab"><?= $estb_year; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Registration No.</label>
                                    </td>
                                    <td>
                                        <label id="reg_lab"><?= $reg_no; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>GST No.</label>
                                    </td>
                                    <td>
                                        <label id="gst_lab"><?= $gst_no; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Language(s) in which books are published:</label>
                                    </td>
                                    <td>
                                        <label id="lang_lab"><?= $book_lang; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>No.of Titles Published</label>
                                    </td>
                                    <td>
                                        <label id="titl_lab"><?= $title_no; ?></label>
                                    </td>
                                </tr>
                                <tr id="nature_row">
                                    <td>
                                        <label>Nature of Organization</label>
                                    </td>
                                    <td>
                                        <label id="natr_lab"><?= $name_org; ?></label>
                                    </td>
                                </tr>
                                <tr id="nature_new"></tr>

                                <tr>
                                    <td class="td-head" colspan="2">
                                        <label>
                                            <h5><b>Head of the Publishing House / Organization</h5></b>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Name</label>
                                    </td>
                                    <td>
                                        <label id="head_nam_lab"><?= $head_name; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Address</label>
                                    </td>
                                    <td>
                                        <label id="head_addr_lab"><?= $head_addr; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Mobile</label>
                                    </td>
                                    <td>
                                        <label id="head_mob_lab"><?= $head_mobile; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Email</label>
                                    </td>
                                    <td>
                                        <label id="head_email_lab"><?= $head_email; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Website</label>
                                    </td>
                                    <td>
                                        <label id="head_site_lab"><?= $head_site; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-head" colspan="2">
                                        <label>
                                            <h5><b>Contact (In-charge) person for the fair</h5></b>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Name</label>
                                    </td>
                                    <td>
                                        <label id="prsn_nam_lab"><?= $prsn_name; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Address</label>
                                    </td>
                                    <td>
                                        <label id="prsn_addr_lab"><?= $prsn_addr; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Mobile</label>
                                    </td>
                                    <td>
                                        <label id="prsn_mob_lab"><?= $prsn_mobile; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Email</label>
                                    </td>
                                    <td>
                                        <label id="prsn_email_lab"><?= $prsn_email; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Whatsapp No.</label>
                                    </td>
                                    <td>
                                        <label id="prsn_wp_lab"><?= $whatsapp; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Facia / Display Text</label>
                                    </td>
                                    <td>
                                        <label id="fascia_lab"><?= $fascia; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Remarks</label>
                                    </td>
                                    <td>
                                        <label id="rmrk_lab"><?= $remark; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Stalls Booked 3*3</label>
                                    </td>
                                    <td>
                                        <label id="rmrk_lab"><?= $stall3x3; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Stalls Booked 3*2</label>
                                    </td>
                                    <td>
                                        <label id="rmrk_lab"><?= $stall3x2; ?></label>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td>
                                        Estimated amount for stall booking</td>
                                    </td>
                                    <td>
                                        <label id="3x3amt_lab"><?= $total_amt; ?></label>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td>
                                        <label> Logo of Publishing House / Organization</label>
                                    </td>
                                    <td>
                                        <label id="logo_lab"><img src="data:image/jpg;charset=utf8;base64,<?= $logo; ?>" height="70vh"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label> Profile Registration Date</label>
                                    </td>
                                    <td>
                                        <label id="logo_lab"><?= $prof_reg_date; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label> Stall Booking Date</label>
                                    </td>
                                    <td>
                                        <label id="logo_lab"><?= $stall_reg_date; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Stalls Alloted 3*3</label>
                                    </td>
                                    <td>
                                        <label><?= $alloted_stall3x3; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Stalls Alloted 3*2</label>
                                    </td>
                                    <td>
                                        <label><?= $alloted_stall3x2; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Amount to be paid (in ₹)</td>
                                    </td>
                                    <td>
                                        <label id="3x3amt_lab"><?= $total_amt; ?></label>
                                    </td>
                                </tr>
                            </table>
                            <div class="button">
                                <button type="submit" name="print" class="btn btn-primary" id="print">Print</button>
                            </div>

                        </form>

                    </div>

                </div>
                <!-- Terms-Condition End-->
            </div>


        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?php include "footer.php"; ?>

    <script>
        function printData() {
            var divToPrint = document.getElementById("preview");
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }

        const btn = document.getElementById("print");
        btn.addEventListener('click', () => printData())
    </script>