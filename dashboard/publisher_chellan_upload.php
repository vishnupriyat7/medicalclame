<?php
ini_set('display_errors', '0');
include "header.php";
include "publisher_sidebar.php";
$user_id = $user['id'];
function convertNumberToWordsForIndia($number)
{
    //A function to convert numbers into Indian readable words with Cores, Lakhs and Thousands.
    $words = array(
        '0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five',
        '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten',
        '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fouteen', '15' => 'fifteen',
        '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'fourty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninty'
    );

    //First find the length of the number
    $number_length = strlen($number);
    //Initialize an empty array
    $number_array = array(0, 0, 0, 0, 0, 0, 0, 0, 0);
    $received_number_array = array();

    //Store all received numbers into an array
    for ($i = 0; $i < $number_length; $i++) {
        $received_number_array[$i] = substr($number, $i, 1);
    }

    //Populate the empty array with the numbers received - most critical operation
    for ($i = 9 - $number_length, $j = 0; $i < 9; $i++, $j++) {
        $number_array[$i] = $received_number_array[$j];
    }

    $number_to_words_string = "";
    //Finding out whether it is teen ? and then multiply by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
    for ($i = 0, $j = 1; $i < 9; $i++, $j++) {
        //"01,23,45,6,78"
        //"00,10,06,7,42"
        //"00,01,90,0,00"
        if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
            if ($number_array[$j] == 0 || $number_array[$i] == "1") {
                $number_array[$j] = intval($number_array[$i]) * 10 + $number_array[$j];
                $number_array[$i] = 0;
            }
        }
    }

    $value = "";
    for ($i = 0; $i < 9; $i++) {
        if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
            $value = $number_array[$i] * 10;
        } else {
            $value = $number_array[$i];
        }
        if ($value != 0) {
            $number_to_words_string .= $words["$value"] . " ";
        }
        if ($i == 1 && $value != 0) {
            $number_to_words_string .= "Crores ";
        }
        if ($i == 3 && $value != 0) {
            $number_to_words_string .= "Lakhs ";
        }
        if ($i == 5 && $value != 0) {
            $number_to_words_string .= "Thousand ";
        }
        if ($i == 6 && $value != 0) {
            $number_to_words_string .= "Hundred ";
        }
    }
    if ($number_length > 9) {
        $number_to_words_string = "Sorry This does not support more than 99 Crores";
    }
    return ucwords(strtolower("Rupees " . $number_to_words_string) . " Only.");
}
function generateInvoice($invoiceNo)
{
    $alphaCode = array(
        "1" => "A",
        "2" => "B",
        "3" => "C",
        "4" => "D",
        "5" => "E",
        "6" => "F",
        "7" => "G",
        "8" => "H",
        "9" => "I",
        "0" => "J"
    );
    $currentDate = new DateTime();
    $year = $currentDate->format("y");
    $arr1 = str_split($year);
    $generatedNo = $alphaCode[$arr1[0]] . $alphaCode[$arr1[1]] . $invoiceNo;
    return $generatedNo;
}
?>
<style>
    #pay-slip td {
        text-align: right !important;
        width: 20%;
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
                        <h4 class="mb-sm-0">Chellan Upload</h4>
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
                        <?php
                        $status = "OK";
                        $msg = "";
                        $current_date = new DateTime();
                        $date = date_format($current_date, "Y-m-d H:i:s");
                        if ($user_id) {
                            $sql_profile = "SELECT id, org_name, gst_no, head_org_email FROM users_profile WHERE user_id = ?";
                            $stmt_prof = $con->prepare($sql_profile);
                            $stmt_prof->bind_param("s", $user_id);
                            $stmt_prof->execute();
                            $res_prof = $stmt_prof->get_result();
                            $user_prof = $res_prof->fetch_assoc();
                            $sql1 = "SELECT * FROM stall_booking WHERE user_id = ?";
                            $stmt1 = $con->prepare($sql1);
                            $stmt1->bind_param("i", $user_id);
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            $user_stall = $result1->fetch_assoc();
                            $stall3x3 = $user_stall['confirm_3X3'];
                            $stall3x2 = $user_stall['confirm_3X2'];
                            $amt3x3 = 10000;
                            $amt3x2 = 7500;
                            $rate3x3 = $stall3x3 * $amt3x3;
                            $rate3x2 = $stall3x2 * $amt3x2;
                            $gst3x3 = ($rate3x3 * 18) / 100;
                            $gst3x2 = ($rate3x2 * 18) / 100;
                            $tot_amt3x3 = $rate3x3 + $gst3x3;
                            $tot_amt3x2 = $rate3x2 +  $gst3x2;
                            // $stall_status = $user_stall['status'];
                            // if ($stall_status != 'S') {
                            //     $edit_count = '';
                            // } else {
                            //     $edit_count = 'disabled';
                            // }
                            $total_amt = $tot_amt3x3 + $tot_amt3x2;
                            $totalinword = convertNumberToWordsForIndia($total_amt);
                            $chellanQuery = "SELECT * FROM challan WHERE user_id = ?";
                            $stmt_chellan = $con->prepare($chellanQuery);
                            $stmt_chellan->bind_param("s", $user_id);
                            $stmt_chellan->execute();
                            $res_chellan = $stmt_chellan->get_result();
                            $chellan = $res_chellan->fetch_assoc();
                            $bank_name = $chellan['bank_name'];
                            $paid_amt = $chellan['paid_amt'];
                            $trnctn_no = $chellan['trnctn_no'];
                            $ifsc = $chellan['ifsc'];
                            $trnctn_dt = $chellan['trnctn_date'];
                            $payee = $chellan['paye_name'];
                            $trnctn_type = $chellan['trnctn_type'];
                            $gst = $user_prof['gst_no'];
                            $chellanStatus = $chellan['status'];
                            $imgChellan = base64_encode($chellan['challan_img']);
                            if ($trnctn_type == 'D') {
                                $select0 = '';
                                $selectd = 'selected';
                                $selecto = '';
                            } else if ($trnctn_type == 'O') {
                                $select0 = '';
                                $selectd = '';
                                $selecto = 'selected';
                            } else {
                                $select0 = 'selected';
                                $selectd = '';
                                $selecto = '';
                            }
                            if ($chellanStatus != 'A') {
                                $edit = '';
                            } else {
                                $edit = 'disabled';
                            }
                            if (!$imgChellan) {
                                $hideimg = '';
                            } else {
                                $hideimg = 'hidden';
                            }
                            // $invcNo = $chellan['invoice_no'];
                            $invoice = generateInvoice($chellan['invoice_no']);
                        } else {
                            $tot_amt3x3 = $tot_amt3x2 = $total_amt = 0;
                            $stall3x3 = 0;
                            $stall3x2 = 0;
                        }

                        if (isset($_POST['save_payment'])) {
                            $bank_name = mysqli_real_escape_string($con, $_POST['bank_name']);
                            $paid_amt = mysqli_real_escape_string($con, $_POST['paid_amt']);
                            $trnctn_no = mysqli_real_escape_string($con, $_POST['trnctn_no']);
                            $trnctn_type = mysqli_real_escape_string($con, $_POST['trnctn_type']);
                            $ifsc = mysqli_real_escape_string($con, $_POST['ifsc']);
                            $trnctn_dt = mysqli_real_escape_string($con, $_POST['trnctn_dt']);
                            $payee = mysqli_real_escape_string($con, $_POST['payee_nme']);
                            $gst = mysqli_real_escape_string($con, $_POST['gst_num']);
                            $current_date = new DateTime();
                            $date = date_format($current_date, "Y-m-d H:i:s");
                            if ($total_amt != $paid_amt) {
                                $msg = 'Transaction amount mismatch. Please enter total amount.';
                                $status = "NOTOK";
                            }
                            if ($trnctn_type == '0') {
                                $msg = 'Please select mode of transaction.';
                                $status = "NOTOK";
                            } elseif ($trnctn_type == 'D') {
                                if ($bank_name == '') {
                                    $msg = 'Please enter Bank Name.';
                                    $status = "NOTOK";
                                }
                                if ($ifsc == '') {
                                    $msg = 'Please enter IFSC.';
                                    $status = "NOTOK";
                                } elseif (strlen($ifsc) != 11) {
                                    $msg = 'IFSC should be 11 characters length.';
                                    $status = "NOTOK";
                                }
                            } elseif ($trnctn_type == 'O') {
                                if ($trnctn_no == '') {
                                    $msg = 'Please enter Transaction Number.';
                                    $status = "NOTOK";
                                }
                            }
                            if ($payee == '') {
                                $msg = 'Please enter payee name.';
                                $status = "NOTOK";
                            }
                            if ($gst != '' && strlen($gst) != 15) {
                                $msg = 'GST Number should be 15 characters length.';
                                $status = "NOTOK";
                            }
                            if (!empty($_FILES["chellan_img"]["name"])) {
                                // Get file info 
                                $fileName = basename($_FILES["chellan_img"]["name"]);
                                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                                // Allow certain file formats 
                                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                                if (in_array($fileType, $allowTypes)) {
                                    $image = $_FILES['chellan_img']['tmp_name'];
                                    $imgContent = addslashes(file_get_contents($image));
                                } else {
                                    $msg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                                    $status = "NOTOK";
                                }
                            } else {
                                if (!$chellan_img && !$imgChellan) {
                                    $msg = 'Please select an image file to upload.';
                                    $status = "NOTOK";
                                }
                            }
                            // $imgChellan =  base64_encode($imgContent);
                            $errormsg = "";
                            if ($status == "NOTOK") {
                                $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>" .
                                    $msg . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                               </div>"; //printing error if found in validation
                            } else {
                                if ($chellan['id'] > 0) {
                                    if ($imgContent) {
                                        $query = "UPDATE challan SET user_id = '$user_id', bank_name = '$bank_name', paid_amt = '$paid_amt', trnctn_no = '$trnctn_no', trnctn_type = '$trnctn_type', trnctn_date = '$trnctn_dt', challan_img = '$imgContent', updated_date = '$date', paye_name = '$payee', ifsc = '$ifsc' WHERE user_id = '$user_id';";
                                    } else {
                                        $query = "UPDATE challan SET user_id = '$user_id', bank_name = '$bank_name', paid_amt = '$paid_amt', trnctn_no = '$trnctn_no', trnctn_type = '$trnctn_type', trnctn_date = '$trnctn_dt', updated_date = '$date', paye_name = '$payee', ifsc = '$ifsc' WHERE user_id = '$user_id';";
                                    }
                                } else {
                                    $query = "INSERT INTO challan (user_id, bank_name, paid_amt, trnctn_no, trnctn_type, trnctn_date, challan_img, status, updated_date, paye_name, ifsc) VALUES ('$user_id', '$bank_name', '$paid_amt', '$trnctn_no', '$trnctn_type', '$trnctn_dt', '$imgContent', 'E', '$date',  '$payee', '$ifsc');";
                                }
                                $querygst = "UPDATE users_profile SET gst_no = '$gst' WHERE user_id = '$user_id';";
                                $result = mysqli_query($con, $query);
                                $resultusergst = mysqli_query($con, $querygst);
                                if ($result && $resultusergst) {
                                    $errormsg = "
                              <div class='alert alert-success alert-dismissible alert-outline fade show'>
                                                Your payment details is Successfully Saved.
                                                <button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button>
                                                </div>
                               ";
                                    $sql_profile = "SELECT id, org_name, gst_no, head_org_email FROM users_profile WHERE user_id = ?";
                                    $stmt_prof = $con->prepare($sql_profile);
                                    $stmt_prof->bind_param("s", $user_id);
                                    $stmt_prof->execute();
                                    $res_prof = $stmt_prof->get_result();
                                    $user_prof = $res_prof->fetch_assoc();
                                    $sql1 = "SELECT * FROM stall_booking WHERE user_id = ?";
                                    $stmt1 = $con->prepare($sql1);
                                    $stmt1->bind_param("i", $user_id);
                                    $stmt1->execute();
                                    $result1 = $stmt1->get_result();
                                    $user_stall = $result1->fetch_assoc();
                                    $stall3x3 = $user_stall['confirm_3X3'];
                                    $stall3x2 = $user_stall['confirm_3X2'];
                                    $amt3x3 = 10000;
                                    $amt3x2 = 7500;
                                    $rate3x3 = $stall3x3 * $amt3x3;
                                    $rate3x2 = $stall3x2 * $amt3x2;
                                    $gst3x3 = ($rate3x3 * 18) / 100;
                                    $gst3x2 = ($rate3x2 * 18) / 100;
                                    $tot_amt3x3 = $rate3x3 + $gst3x3;
                                    $tot_amt3x2 = $rate3x2 +  $gst3x2;
                                    // $stall_status = $user_stall['status'];
                                    // if ($stall_status != 'S') {
                                    //     $edit_count = '';
                                    // } else {
                                    //     $edit_count = 'disabled';
                                    // }
                                    $total_amt = $tot_amt3x3 + $tot_amt3x2;
                                    $totalinword = convertNumberToWordsForIndia($total_amt);
                                    $chellanQuery = "SELECT * FROM challan WHERE user_id = ?";
                                    $stmt_chellan = $con->prepare($chellanQuery);
                                    $stmt_chellan->bind_param("s", $user_id);
                                    $stmt_chellan->execute();
                                    $res_chellan = $stmt_chellan->get_result();
                                    $chellan = $res_chellan->fetch_assoc();
                                    $bank_name = $chellan['bank_name'];
                                    $paid_amt = $chellan['paid_amt'];
                                    $trnctn_no = $chellan['trnctn_no'];
                                    $ifsc = $chellan['ifsc'];
                                    $trnctn_dt = $chellan['trnctn_date'];
                                    $payee = $chellan['paye_name'];
                                    $trnctn_type = $chellan['trnctn_type'];
                                    $gst = $user_prof['gst_no'];
                                    $chellanStatus = $chellan['status'];
                                    $imgChellan = base64_encode($chellan['challan_img']);
                                } else {
                                    $errormsg = "
                                    <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                               Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help test.
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
                                    <div class="col-12">
                                        <label><b>Stall Allotment Details</b></label>
                                    </div>
                                    <div class="row">
                                        <table class="table table-info table-responsive" id="pay-slip">
                                            <tr>
                                                <th>
                                                    Stalls
                                                </th>
                                                <th>
                                                    Alloted
                                                </th>
                                                <th>
                                                    Rate
                                                </th>
                                                <th>
                                                    GST(18%)
                                                </th>
                                                <th>Amount</th>
                                            </tr>
                                            <tbody>
                                                <tr>
                                                    <th>3m X 3m</th>
                                                    <td class="text-justify"><?= $stall3x3; ?></td>&emsp;
                                                    <td><?= $rate3x3; ?></td>
                                                    <td><?= $gst3x3; ?></td>
                                                    <td><?= $tot_amt3x3; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>3m X 2m</th>
                                                    <td><?= $stall3x2; ?></td>
                                                    <td><?= $rate3x2; ?></td>
                                                    <td><?= $gst3x2; ?></td>
                                                    <td><?= $tot_amt3x2; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">Total amount payable (in ₹&nbsp;&nbsp;).</td>
                                                    <td><b><?= $total_amt; ?></b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-md-4 right">
                                            <button name="print" class="btn btn-primary" id="print-slip" onclick="printSlip()">Print Payment Slip</button>
                                        </div>
                                    </div><br>
                                    <hr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row bg-grey">
                                            <div class="form-group col-12">
                                                <br>
                                                <label><b>Upload your Payment Details</b></label>
                                            </div>
                                            <div class="form-group col-12 col-md-3">
                                                <br>*Mode of Payment
                                                <select class="form-control form-group" name="trnctn_type" id="trnctn_type" required="required" style="height:37px;" <?= $edit; ?> onchange="paymentMode()">
                                                    <option value="0" <?= $select0; ?>>Select</option>
                                                    <option value="D" <?= $selectd; ?>>Cash Deposit</option>
                                                    <option value="O" <?= $selecto; ?>>Online Transfer</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12 col-md-9" id="bank-name-div" hidden>
                                                <br>
                                                Bank Name
                                                <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" id="bank_name" value="<?= $bank_name; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-12 col-md-3">
                                                <br>
                                                *Transaction Amount (in ₹ &nbsp;)
                                                <input type="text" class="form-control" name="paid_amt" id="paid_amt" placeholder="*Paid Amount (in  ₹ &nbsp;)" required="required" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" <?= $edit; ?> value="<?= $total_amt; ?>">
                                            </div>
                                            <div class="form-group col-12 col-md-3" hidden id="trnctn-no-div">
                                                <br>
                                                Transaction No
                                                <input type="text" class="form-control" name="trnctn_no" id="trnctn_no" placeholder="Transaction No" value="<?= $trnctn_no; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-12 col-md-3" hidden id="ifsc-div">
                                                <br>
                                                IFSC
                                                <input type="text" class="form-control" name="ifsc" id="ifsc" placeholder="IFSC" value="<?= $ifsc; ?>" maxlength="11" minlength="11" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-12 col-md-3">
                                                <br>
                                                *Transaction Date
                                                <input type="date" class="form-control" name="trnctn_dt" id="trnctn_dt" placeholder="*Transaction Date" required="required" value="<?= $trnctn_dt; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <br>
                                                Organization Name
                                                <input type="text" class="form-control" value="<?= $user_prof['org_name']; ?>" disabled>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <br>
                                                *Payee Name
                                                <input type="text" class="form-control" name="payee_nme" id="payee_nme" placeholder="*Payee Name" required="required" value="<?= $payee; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <br>
                                                GST Number
                                                <input type="text" class="form-control" name="gst_num" id="gst_num" placeholder="GST Number" minlength="15" maxlength="15" value="<?= $gst; ?>" <?= $edit; ?>>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                </br>
                                                *Upload Payment Image
                                                </br>
                                                <input type="file" class="form-control" name="chellan_img" id="chellan_img" placeholder="*Upload Chellan Image" <?= $edit; ?> <?= $hideimg; ?>>
                                                <label id="chellan_image">
                                                    <img src="data:image/jpg;charset=utf8;base64,<?= $imgChellan; ?>" height="100vh" id="image_chellan" <?= $edit; ?>>
                                                </label>
                                                <span id="changeChellan" onclick="changeChellan();" <?= $edit; ?>><u>Change Chellan Image</u></span>
                                            </div>
                                        </div> <br>
                                        <div class="col-lg-12">
                                            <?php if ($chellan['status'] != 'A') {  ?>
                                                <button type="submit" name="save_payment" class="btn btn-primary" id="save_payment">Save</button>
                                            <?php } ?>
                                            <br><br>
                                            <medium class="text-danger">Disclaimer: <br>* Once your payment is made, the amount should not refund.<br></medium>

                                        </div>
                                    </form>
                                    <?php if ($chellan['status'] == 'A') {  ?>
                                        <hr><br>
                                        <div class="col-md-4 right">
                                            <button name="print-invoice" class="btn btn-primary" id="print-invoice" onclick="printInvoice()">Print Invoice</button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <iframe id="print-frame" style="display: none;"></iframe>
    <!-- End Page-content -->

    <?php include "footer.php"; ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;
        document.addEventListener("DOMContentLoaded", function() {
            paymentMode();
        });

        function changeChellan() {
            $("#chellan_img").removeAttr('hidden');
            $("#chellan_image").remove();
        }

        function paymentMode() {
            var mode = $("#trnctn_type").val();
            if (mode === 'D') {
                document.getElementById("bank-name-div").removeAttribute("hidden", "");
                document.getElementById("ifsc-div").removeAttribute("hidden", "");
                document.getElementById("trnctn-no-div").setAttribute("hidden", "");
            } else if (mode === 'O') {
                document.getElementById("bank-name-div").setAttribute("hidden", "");
                document.getElementById("ifsc-div").setAttribute("hidden", "");
                document.getElementById("trnctn-no-div").removeAttribute("hidden", "");
            } else {
                document.getElementById("bank-name-div").setAttribute("hidden", "");
                document.getElementById("ifsc-div").setAttribute("hidden", "");
                document.getElementById("trnctn-no-div").setAttribute("hidden", "");
            }
        }

        function printSlip() {
            var orgName = <?php echo json_encode($user_prof['org_name']) ?>;
            var stall3x3 = <?php echo json_encode($stall3x3) ?>;
            var stall3x3 = <?php echo json_encode($stall3x3) ?>;
            var rate3x3 = <?php echo json_encode($rate3x3) ?>;
            var gst3x3 = <?php echo json_encode($gst3x3) ?>;
            var totAmt3x3 = <?php echo json_encode($tot_amt3x3) ?>;
            var stall3x2 = <?php echo json_encode($stall3x2) ?>;
            var rate3x2 = <?php echo json_encode($rate3x2) ?>;
            var gst3x2 = <?php echo json_encode($gst3x2) ?>;
            var totAmt3x2 = <?php echo json_encode($tot_amt3x2) ?>;
            var totalAmt = <?php echo json_encode($total_amt) ?>;
            var totwords = <?php echo json_encode($totalinword) ?>
            // ... (other variables)

            var htmlContent = '<html><head> <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" /><link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" /><link href="assets/css/app.min.css" rel="stylesheet" type="text/css" /><link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" /></head><body><br><label><img src="assets/images/Logo_01.png" height="70vh" style="float: left;"></label><h3><b>PAYMENT SLIP</b></h3><br><h4><b>Organization:' + orgName + '</h4><table class="table table-info table-responsive" id="pay-slip"><tr><th>Stalls</th><th>Alloted</th><th>Rate</th><th>GST(18%)</th><th>Amount</th></tr><tbody><tr><th>3m X 3m</th><td class="text-justify">' + stall3x3 + '</td><td>' + rate3x3 + '</td><td>' + gst3x3 + '</td><td>' + totAmt3x3 + '</td></tr><tr><th>3m X 2m</th><td>' + stall3x2 + '</td><td>' + rate3x2 + '</td><td>' + gst3x2 + '</td><td>' + totAmt3x2 + '</td></tr><tr><td colspan="4">Total amount payable (in ₹&nbsp;&nbsp;).</td><td><b>' + totalAmt + '</b></td></tr><tr><td colspan="2">Total amount payable (in words).</td><td colspan="3"><b>' + totwords + '</b></td></tr></tbody></table><br><br><b><u>Details of bank account to which payment is to be made:</u></b><br><br>Bank Account Number - 67279812893<br>Name of Bank, Branch  - State Bank of India, Trivandrum City<br>Account holder’s name  - Finance Officer, Kerala Legislature Secretariat<br>IFS Code - SBIN0070028</body></html>';

            var iframe = document.getElementById("print-frame");
            iframe.contentDocument.write(htmlContent);
            iframe.contentDocument.close();
            iframe.focus(); // Optional: focus on the iframe
            iframe.contentWindow.print();
        }

        function printInvoice() {
            var stall3x3 = <?php echo json_encode($stall3x3) ?>;
            var stall3x2 = <?php echo json_encode($stall3x2) ?>;
            var slno = 0;
            var desc3x3 = "";
            var desc3x2 = "";
            var divToPrint = document.getElementById("pay-slip");
            newWin = window.open("");
            newWin.document.write('<html><head> <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" /><link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" /><link href="assets/css/app.min.css" rel="stylesheet" type="text/css" /><link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" /></head><body><style>td, th {font-size:12;} .center {display: block; margin-left: auto; margin-right: auto;width: auto; }</style>');
            newWin.document.write('<br><div class="text-center"><img src="assets/images/Govt_Logo.png" height="70vh" class="center"><br></div><table><tr><th colspan="11" class="text-center">SECRETARIAT OF THE KERALA LEGISLATURE<br></th></tr><tr><td>Post Box No:</td><td>5430</td><td colspan="6"></td><td>GSTN: </td><td><b>32AAAGK0786J1ZD</b></td></tr><tr><td>PIN:</td><td>695 033</td></tr><tr><td>Email:</td><td>secretary@niyamasabha.nic.in</td></tr><tr><th class="text-center" colspan="11"><br><br><br><br>INVOICE<br></th></tr><tr><td rowspan="2">Bill To</td><td rowspan="2">');
            newWin.document.write(<?php echo json_encode($user_prof['org_name']) ?>);
            newWin.document.write('<br>');
            newWin.document.write(<?php echo json_encode($user_prof['head_org_email']) ?>);
            newWin.document.write('</td><td colspan="4"></td><td colspan="3">Invoice No</td><td>');
            newWin.document.write(<?php echo json_encode($invoice) ?>);
            newWin.document.write('</td></tr><tr><td colspan="4"></td><td colspan="3">Invoice Date</td><td>');
            newWin.document.write(<?php echo json_encode($chellan['updated_date']) ?>);
            newWin.document.write('</td></tr><tr><td>GSTIN: </td><td>');
            newWin.document.write(<?php echo json_encode($user_prof['gst_no']) ?>);
            newWin.document.write('</td></tr><tr><td colspan="11"><br><br></td></tr><tr><td rowspan="2" style="text-align: center;">No</td><td rowspan="2" style="text-align: center;">Item Description</td><td rowspan="2" style="text-align: center;">HSN/<br>SAC</td><td rowspan="2" style="text-align: center;">Qty</td><td rowspan="2" style="text-align: center;">Unit Price</td><td rowspan="2" style="text-align: center;">Taxable Amount</td><td colspan="3" style="text-align: center;">GST</td><td rowspan="2" style="text-align: center;">Total</td></tr><tr><td style="text-align: center;">%</td><td style="text-align: center;">SGST</td><td style="text-align: center;">CGST</td></tr><tr><td style="text-align: center;">');

            if (stall3x3 > 0) {
                newWin.document.write(++slno);
                newWin.document.write('</td><td>Rent for Stall 3x3m 01/11/2023-07/11/2023</td><td>997222</td><td style="text-align: right;">&emsp;');
                newWin.document.write(stall3x3);
                newWin.document.write('</td><td style="text-align: right;">10000</td><td style="text-align: right;">');
                newWin.document.write(<?php echo json_encode($rate3x3) ?>);
                newWin.document.write('</td><td style="text-align: right;">18</td><td style="text-align: right;">');
                newWin.document.write(<?php echo json_encode($gst3x3 / 2) ?>);
                newWin.document.write('</td><td style="text-align: right;">');
                newWin.document.write(<?php echo json_encode($gst3x3 / 2) ?>);
                newWin.document.write('</td><td style="text-align: right;">');
                newWin.document.write(<?php echo json_encode($tot_amt3x3) ?>);
            }
            if (stall3x2 > 0) {
                newWin.document.write(++slno);
                newWin.document.write('</td><td>Rent for Stall 3x2m 01/11/2023-07/11/2023</td><td>997222</td><td style="text-align: right;">');
                newWin.document.write(stall3x2);
                newWin.document.write('</td><td style="text-align: right;">8500</td><td style="text-align: right;">');
                newWin.document.write(<?php echo json_encode($rate3x2) ?>);
                newWin.document.write('</td><td style="text-align: right;">18</td><td style="text-align: right;">');
                newWin.document.write(<?php echo json_encode($gst3x2 / 2) ?>);
                newWin.document.write('</td><td style="text-align: right;">');
                newWin.document.write(<?php echo json_encode($gst3x2 / 2) ?>);
                newWin.document.write('</td><td style="text-align: right;">');
                newWin.document.write(<?php echo json_encode($tot_amt3x2) ?>);
            }
            newWin.document.write('</td></tr><tr><td colspan="11"><br><br></td></tr><tr><td colspan="3" style="text-align: right;">Total</td><td style="text-align: right;">');
            newWin.document.write(stall3x3 + stall3x2);
            newWin.document.write('</td><td></td><td style="text-align: right;">');
            newWin.document.write(<?php echo json_encode($rate3x3 + $rate3x2) ?>);
            newWin.document.write('</td><td></td><td style="text-align: right;">');
            newWin.document.write(<?php echo json_encode(($gst3x3 + $gst3x2) / 2) ?>);
            newWin.document.write('</td><td style="text-align: right;">');
            newWin.document.write(<?php echo json_encode(($gst3x3 + $gst3x2) / 2) ?>);
            newWin.document.write('</td><td style="text-align: right;">');
            newWin.document.write(<?php echo json_encode($total_amt) ?>);
            newWin.document.write('</td></tr><tr><td colspan="11"><br><br></td></tr><tr><td colspan="4" style="text-align: right;">Total Taxable Amount</td><td colspan="7" style="text-align: right;">');
            newWin.document.write(<?php echo json_encode($rate3x3 + $rate3x2) ?>);
            newWin.document.write('</td></tr><tr><td colspan="4" style="text-align: right;">Total Tax Amount</td><td colspan="7" style="text-align: right;">');
            newWin.document.write(<?php echo json_encode(($gst3x3 + $gst3x2)) ?>);
            newWin.document.write('</td></tr><tr><td colspan="4" style="text-align: right;">Total Amount</td><td colspan="7" style="text-align: right;">');
            newWin.document.write(<?php echo json_encode($total_amt) ?>);
            newWin.document.write('</td></tr><tr><td colspan="4" style="text-align: right;">Amount Due</td><td colspan="7" style="text-align: right;">');
            newWin.document.write(<?php echo json_encode($total_amt) ?>);
            newWin.document.write('</td></tr><tr><td colspan="4" style="text-align: right;">Total (in words)</td><td colspan="7" style="text-align: right;">');
            newWin.document.write(<?php echo json_encode($totalinword) ?>);
            newWin.document.write('</td></tr><tr><td colspan="11" style="text-align: right;"><br><br><br><br><br><br><br>Authorized Signatory</td></tr></table></body></html>');
            newWin.print();
            newWin.close();
        }
    </script>