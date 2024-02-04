<?php
ini_set('display_errors', '0');
include "header.php";
include "publisher_sidebar.php";
$user_id = $user['id'];
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
                        <h4 class="mb-sm-0">Add Bill</h4>
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
                        $select_pub_bank_query = "SELECT * FROM coupon_bankdtls WHERE users_id = ?";
                        $stmt_pub_cpn_bank = $con->prepare($select_pub_bank_query);
                        $stmt_pub_cpn_bank->bind_param("s", $user_id);
                        $stmt_pub_cpn_bank->execute();
                        $res_pub_cpn_bank = $stmt_pub_cpn_bank->get_result();
                        $cpn_bank_det = $res_pub_cpn_bank->fetch_assoc();
                        $edit_bank = '';
                        if ($cpn_bank_det) {
                            $cpn_bank_name = $cpn_bank_det['bank_name'];
                            $cpn_bank_branch = $cpn_bank_det['account_no'];
                            $cpn_acc_no = $cpn_bank_det['bank_branch'];
                            $cpn_ifsc = $cpn_bank_det['bank_ifsc'];
                            $edit_bank = "disabled";
                        }
                        if (isset($_POST['save_cpn'])) {
                            $cpn_bank_name = mysqli_real_escape_string($con, $_POST['cpn_bank_name']);
                            $cpn_bank_branch = mysqli_real_escape_string($con, $_POST['cpn_bank_branch']);
                            $cpn_acc_no = mysqli_real_escape_string($con, $_POST['cpn_acc_no']);
                            $cpn_ifsc = mysqli_real_escape_string($con, $_POST['cpn_ifsc']);
                            $count50 = mysqli_real_escape_string($con, $_POST['count50']);
                            $cpn_serial_50 = mysqli_real_escape_string($con, $_POST['cpn_serial_50']);
                            $count100 = mysqli_real_escape_string($con, $_POST['count100']);
                            $cpn_serial_100 = mysqli_real_escape_string($con, $_POST['cpn_serial_100']);
                            $count200 = mysqli_real_escape_string($con, $_POST['count200']);
                            $cpn_serial_200 = mysqli_real_escape_string($con, $_POST['cpn_serial_200']);
                            $cpn_invoice = mysqli_real_escape_string($con, $_POST['cpn_invoice']);
                            $cpn_bill_qry = "SELECT * FROM coupon_publisher WHERE cpn_bill_no = '$cpn_invoice'";
                            $cpn_bill = mysqli_query($con, $cpn_bill_qry);
                            if ($cpn_bill->num_rows > 0) {
                                $status = "NOTOK";
                                $msg = "Duplicate Invoice number. Please enetr a different one.";
                            }
                            $total_cpn_amt = ($count100 * 100) + ($count200 * 200) + ($count50 * 50);
                            $current_date = new DateTime();
                            $date = date_format($current_date, "Y-m-d H:i:s");
                            $select_pub_bank_query = "SELECT * FROM coupon_bankdtls WHERE users_id = ?";
                            $stmt_pub_cpn_bank = $con->prepare($select_pub_bank_query);
                            $stmt_pub_cpn_bank->bind_param("s", $user_id);
                            $stmt_pub_cpn_bank->execute();
                            $res_pub_cpn_bank = $stmt_pub_cpn_bank->get_result();
                            $cpn_bank_det = $res_pub_cpn_bank->fetch_assoc();
                            if (!$cpn_bank_det) {
                                $query_cpn_pub_bank = "INSERT INTO coupon_bankdtls (users_id, bank_name, account_no, bank_ifsc, bank_branch, updated_date) values ('$user_id', '$cpn_bank_name', '$cpn_acc_no', '$cpn_ifsc', '$cpn_bank_branch', '$date')";
                                $res_cpn_pub_bank = mysqli_query($con, $query_cpn_pub_bank);
                                if (!$res_cpn_pub_bank) {
                                    $status = "NOTOK";
                                    $msg = "Some issues in insertion of bank details.";
                                }
                            }
                            $errormsg = "";
                            if ($status == "NOTOK") {
                                $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>" .
                                    $msg . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                               </div>"; //printing error if found in validation
                            } else {
                                $query_cpn_pub = "INSERT INTO coupon_publisher (users_id, cpn_200_count, cpn_100_count, cpn_50_count, cpn_50_srlno, cpn_100_srlno, cpn_200_srlno, cpn_bill_no, total_amount, updated_date, status) values ('$user_id', '$count200', '$count100', '$count50', '$cpn_serial_50', '$cpn_serial_100', '$cpn_serial_200', '$cpn_invoice', '$total_cpn_amt', '$date', 'E')";
                                $res_cpn_pub = mysqli_query($con, $query_cpn_pub);
                                if ($res_cpn_pub) {
                                    $errormsg = "
                              <div class='alert alert-success alert-dismissible alert-outline fade show'>
                                                Your payment details is Successfully Saved.
                                                <button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button>
                                                </div>
                               ";
                                    $cpn_bank_name = $cpn_bank_det['bank_name'];
                                    $cpn_bank_branch = $cpn_bank_det['account_no'];
                                    $cpn_acc_no = $cpn_bank_det['bank_branch'];
                                    $cpn_ifsc = $cpn_bank_det['bank_ifsc'];
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
                        <!-- <div id="add_new_customer_model">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #ff5252; color: white">
                                        <div class="font-weight-bold">Add New Customer</div>
                                        <button class="close" style="outline: none;" onclick="document.getElementById('add_new_customer_model').style.display = 'none';"><i class="fa fa-close"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        include 'sections/add_new_customer.html';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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

                                            <!-- <div class="row col col-md-12">
                                                <div class="col col-md-2 form-group">
                                                    <button class="btn btn-primary form-control" onclick="document.getElementById('add_new_customer_model').style.display = 'block';">Add New Medicine</button>
                                                </div>
                                                <div class="col col-md-1 form-group"></div>

                                            </div> -->


                                            <div class="col col-md-12">
                                                <hr class="col-md-12" style="padding: 0px; border-top: 3px solid  #02b6ff;">
                                            </div>

                                            <!-- add medicines -->
                                            <div class="row col col-md-12">
                                                <div class="row col col-md-12 font-weight-bold">
                                                    <div class="col col-md-1">Sl No</div>
                                                    <div class="col col-md-1">Invoice No</div>
                                                    <div class="col col-md-1">Invoice Date</div>
                                                    <div class="col col-md-2">Medicine Name</div>
                                                    <div class="col col-md-3">Chemical/Pharmacological Name</div>
                                                    <div class="col col-md-2">Price Description</div>
                                                    <div class="col col-md-1">Total Amount</div>
                                                    <div class="col col-md-1">Remarks</div>
                                                </div>
                                            </div>
                                            <div class="col col-md-12">
                                                <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
                                            </div>
                                            <!-- <div class="row col col-md-12">
                                                <div class="row col col-md-12 font-weight-bold">
                                                    <div class="col col-md-1">Sl No</div>
                                                    <div class="col col-md-1">Invoice No</div>
                                                    <div class="col col-md-1">Invoice Date</div>
                                                    <div class="col col-md-2">Medicine Name</div>
                                                    <div class="col col-md-3">Chemical/Pharmacological Name</div>
                                                    <div class="col col-md-2">Price Description</div>
                                                    <div class="col col-md-1">Total Amount</div>
                                                    <div class="col col-md-1">Remarks</div>
                                                </div>
                                            </div> -->
                                            <div class="row col col-md-12 " id="invoice_medicine_list_div">
            <script> addRow(); getInvoiceNumber(); </script>
          </div>
                                            <!-- end medicines -->
                                            <div class="row col col-md-12">
                                                <div class="col col-md-6 form-group"></div>
                                                <div class="col col-md-2 form-group float-right">
                                                    <label class="font-weight-bold" for="">Total Amount:</label>
                                                    <input type="text" class="form-control" value="0" id="total_amount" disabled>
                                                </div>

                                            </div>



                                            <div class="col col-md-12">
                                                <hr class="col-md-12" style="padding: 0px;">
                                            </div>

                                            <div class="row col col-md-12">
                                                <div id="save_button" class="col col-md-2 form-group float-right">
                                                    <label class="font-weight-bold" for=""></label>
                                                    <button class="btn btn-success form-control font-weight-bold" onclick="addInvoice();">Save</button>
                                                </div>
                                                <div id="new_invoice_button" class="col col-md-2 form-group float-right" style="display: none;">
                                                    <label class="font-weight-bold" for=""></label>
                                                    <button class="btn btn-primary form-control font-weight-bold" onclick="location.reload();;">New Invoice</button>
                                                </div>
                                                <div id="print_button" class="col col-md-2 form-group float-right" style="display: none;">
                                                    <label class="font-weight-bold" for=""></label>
                                                    <button class="btn btn-warning form-control font-weight-bold" onclick="printInvoice(document.getElementById('invoice_number').value);">Print</button>
                                                </div>
                                                <div class="col col-md-4 form-group"></div>

                                            </div>

                                            <div id="invoice_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;" </div>

                                            </div>
                                        </div>

                                    </form>
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
        function addRow() {
            if (typeof addRow.counter == 'undefined')
                addRow.counter = 1;
            var previous = document.getElementById("invoice_medicine_list_div").innerHTML;
            var node = document.createElement("div");
            var cls = document.createAttribute("id");
            cls.value = "medicine_row_" + addRow.counter;
            node.setAttributeNode(cls);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState = 4 && xhttp.status == 200) {
                    node.innerHTML = xhttp.responseText;
                    document.getElementById("invoice_medicine_list_div").appendChild(node);
                }
            };
            xhttp.open("GET", "php/add_new_invoice.php?action=add_row&row_id=" + cls.value + "&row_number=" + addRow.counter, true);
            xhttp.send();
            //alert(addRow.counter);
            addRow.counter++;
            rows++;
        }

        function removeRow(row_id) {
            if (rows == 1)
                alert("Can't delete only one row is there!");
            else {
                document.getElementById(row_id).remove();
                rows--;
            }
        }

        function addInvoice() {
            // save invoice
            var customers_name = document.getElementById('customers_name');
            var customers_contact_number = document.getElementById('customers_contact_number');
            var invoice_number = document.getElementById('invoice_number');
            var payment_type = document.getElementById('payment_type');
            var invoice_date = document.getElementById('invoice_date');
            //alert(invoice_number.value);

            if (!notNull(customers_name.value, "customer_name_error"))
                customers_name.focus();
            else if (isCustomer(customers_name.value, customers_contact_number.value) == "false") {
                document.getElementById("customer_name_error").style.display = "block";
                document.getElementById("customer_name_error").innerHTML = "Customer doesn't exists!";
                customers_name.focus();
            } else if (isInvoiceExist(invoice_number.value) == "true")
                document.getElementById("invoice_acknowledgement").innerHTML = "Alreay saved Invoice!";
            else if (!checkDate(invoice_date.value, 'date_error'))
                invoice_date.focus();
            else {
                var parent = document.getElementById('invoice_medicine_list_div');
                var row_count = parent.childElementCount;
                var medicine_info = parent.children;

                var medicines = new Array(row_count - 1);
                for (var i = 1; i < row_count; i++) {
                    //alert(i);
                    var elements_count = medicine_info[i].childElementCount;
                    var elements = medicine_info[i].children;

                    var medicine_name = elements[0].children[0].children[0];
                    var medicine_name_error = elements[0].children[0].children[1];

                    //var packing = elements[0].children[1].children[0];
                    //var pack_error = elements[0].children[1].children[1];

                    var batch_id = elements[0].children[1].children[0];
                    //var batch_id_error = elements[0].children[2].children[1];

                    var expiry_date = elements[0].children[3].children[0];
                    //var expiry_date_error = elements[0].children[3].children[1];

                    var quantity = elements[0].children[4].children[0];
                    var quantity_error = elements[0].children[4].children[1];

                    var mrp = elements[0].children[5].children[0];
                    //var mrp_error = elements[0].children[5].children[1];

                    var discount = elements[0].children[6].children[0];
                    var discount_error = elements[0].children[6].children[1];

                    var total = elements[0].children[7].children[0];

                    var total_amount = document.getElementById("total_amount");
                    var total_discount = document.getElementById("total_discount");
                    var net_total = document.getElementById("net_total");

                    var flag = false;
                    //alert(quantity.getAttribute('id').slice(9, 10));

                    //alert(medicine_name.value + " " + batch_id.value + " " + expiry_date.value + " " + quantity.value + " " + mrp.value + " " + discount.value + " " +total.value);
                    var isAvailable = checkAvailableQuantity(quantity.value, quantity.getAttribute('id').slice(9, 10))
                    //alert(medicine_name.value);
                    if (!notNull(medicine_name.value, medicine_name_error.getAttribute('id')))
                        medicine_name.focus();

                    else if (isMedicine(medicine_name.value) == "false") {
                        medicine_name_error.style.display = "block";
                        medicine_name_error.innerHTML = "Medicine doesn't exists!";
                        medicine_name.focus();
                    } else if (!checkExpiry(expiry_date.value, medicine_name_error.getAttribute('id')) || checkExpiry(expiry_date.value, medicine_name_error.getAttribute('id')) == -1)
                        medicine_name.focus();

                    else if (isAvailable == -1) {
                        medicine_name_error.style.display = "block";
                        medicine_name.focus();
                    } else if (!checkQuantity(quantity.value, quantity_error.getAttribute('id')))
                        quantity.focus();

                    else if (quantity.value == 0) {
                        quantity_error.style.display = "block";
                        quantity_error.innerHTML = "Increase quantity or remover row!";
                        quantity.focus();
                    } else if (isAvailable == -2) {
                        quantity_error.style.display = "block";
                        quantity.focus();
                    } else if (!checkValue(discount.value, discount_error.getAttribute('id')))
                        discount.focus();

                    else {
                        flag = true;
                        //alert("row " + i + "perfect...");
                        medicines[i - 1] = new MedicineInfo(medicine_name.value, batch_id.value, expiry_date.value, quantity.value, mrp.value, discount.value, total.value);
                    }

                    if (!flag)
                        return false;
                }

                for (var i = 0; i < row_count - 1; i++) {
                    updateStock(medicines[i].name, medicines[i].batch_id, medicines[i].quantity);
                    addSale(customers_name.value, customers_contact_number.value, invoice_number.value, medicines[i].name, medicines[i].batch_id, medicines[i].expiry_date, medicines[i].quantity, medicines[i].mrp, medicines[i].discount, medicines[i].total);
                }
                addNewInvoice(customers_name.value, customers_contact_number.value, invoice_date.value, total_amount.value, total_discount.value, net_total.value);
                document.getElementById("save_button").style.display = "none";
                document.getElementById("new_invoice_button").style.display = "block";
                document.getElementById("print_button").style.display = "block";
            }
            return false;
        }
    </script>