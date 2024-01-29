<?php include "header.php"; ?>
<?php include "sidebar_pgmcmtee.php"; ?>

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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="width: 250%;">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Stall Booking Report</h5>
                        </div>
                        <div class="card-body overflow-auto">
                            <!-- <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%"> -->
                            <button onclick="exportTableToExcel('example', 'publisher_profile_report-data')" class="btn btn-primary">Export Table Data To Excel File</button>
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped" style="font-style:normal; font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th data-ordering="false">Sl.No</th>
                                        <th data-ordering="false">Organization Name</th>
                                        <th data-ordering="false">Established Year</th>
                                        <th data-ordering="false">Registration Number</th>
                                        <th data-ordering="false">GST Number</th>
                                        <th data-ordering="false">Languages in which Book Published</th>
                                        <th data-ordering="false">Number of Titles Published</th>
                                        <th data-ordering="false">Nature of Organization</th>
                                        <th data-ordering="false">Major Publishing Houses</th>
                                        <th data-ordering="false">Head of Publishing House / Organization</th>
                                        <th data-ordering="false">Address of Publishing House / Organization</th>
                                        <th data-ordering="false">Mobile Number of Publishing House / Organization</th>
                                        <th data-ordering="false">Email Id of Publishing House / Organization</th>
                                        <th data-ordering="false">Website of Publishing House / Organization</th>
                                        <th data-ordering="false">Contact Person Name</th>
                                        <th data-ordering="false">Contact Person Address</th>
                                        <th data-ordering="false">Contact Person Mobile</th>
                                        <th data-ordering="false">Contact Person Email</th>
                                        <th data-ordering="false">Contact Person whatsapp</th>
                                        <!-- <th data-ordering="false">Number of Stalls 3X3</th>
                                        <th data-ordering="false">Number of Stalls 3X2</th> -->
                                        <th data-ordering="false">Status</th>
                                        <th data-ordering="false">Date Applied</th>
                                        <th data-ordering="false">Logo</th>
                                        <th data-ordering="false">FASIA</th>
                                        <th data-ordering="false">Remarks</th>
                                        <th>Action</th>
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM users_profile ORDER BY id DESC";
                                    // var_dump($query);
                                    $bookstall = mysqli_query($con, $query);
                                    // var_dump(mysqli_fetch_array($bookstall));
                                    $counter = 0;
                                    while ($book = mysqli_fetch_array($bookstall)) {
                                        $id = "$book[id]";
                                        $org_name = "$book[org_name]";
                                        $estb_year = "$book[estb_year]";
                                        $reg_no = "$book[reg_no]";
                                        $gst_no = "$book[gst_no]";
                                        $book_lang = "$book[book_lang]";
                                        $title_no = "$book[title_no]";
                                        $org_nature = "$book[org_nature]";
                                        if ($org_nature == 'P') {
                                            $org_distributer = "Publisher";
                                        } else {
                                            $org_distributer = "Publisher & Distributor";
                                        }
                                        $mgr_house_name = "$book[mgr_house_name]";
                                        $head_org_name = "$book[head_org_name]";
                                        $head_org_addr = "$book[head_org_addr]";
                                        $head_org_mobile = "$book[head_org_mobile]";
                                        $head_org_email = "$book[head_org_email]";
                                        $head_org_website = "$book[head_org_website]";
                                        $cntct_prsn_name = "$book[cntct_prsn_name]";
                                        $cntct_prsn_addr = "$book[cntct_prsn_addr]";
                                        $cntct_prsn_mobile = "$book[cntct_prsn_mobile]";
                                        $cntct_prsn_email = "$book[cntct_prsn_email]";
                                        $cntct_prsn_watsapp = "$book[cntct_prsn_watsapp]";
                                        // $stalls_3x3 = "$book[stalls_3x3]";
                                        // $stalls_3x2 = "$book[stalls_3x2]";
                                        $status = "$book[status]";
                                        $date = "$book[updated_at]";
                                        $logo = base64_encode($book['logo']);
                                        $fascia = "$book[fascia]";
                                        $remarks = "$book[remarks]";
                                    ?>
                                        <tr>
                                            <td>
                                                <?= ++$counter; ?>
                                            </td>
                                            <td>
                                                <?= $org_name; ?>
                                            </td>
                                            <td>
                                                <?= $estb_year; ?>
                                            </td>
                                            <td>
                                                <?= $reg_no; ?>
                                            </td>
                                            <td>
                                                <?= $gst_no; ?>
                                            </td>
                                            <td>
                                                <?= $book_lang; ?>
                                            </td>
                                            <td>
                                                <?= $title_no; ?>
                                            </td>
                                            <td>
                                                <?= $org_distributer; ?>
                                            </td>
                                            <td>
                                                <?= $mgr_house_name; ?>
                                            </td>
                                            <td>
                                                <?= $head_org_name; ?>
                                            </td>
                                            <td>
                                                <?= $head_org_addr; ?>
                                            </td>
                                            <td>
                                                <?= $head_org_mobile; ?>
                                            </td>
                                            <td>
                                                <?= $head_org_email; ?>
                                            </td>
                                            <td>
                                                <?= $head_org_website; ?>
                                            </td>
                                            <td>
                                                <?= $cntct_prsn_name; ?>
                                            </td>
                                            <td>
                                                <?= $cntct_prsn_addr; ?>
                                            </td>
                                            <td>
                                                <?= $cntct_prsn_mobile; ?>
                                            </td>
                                            <td>
                                                <?= $cntct_prsn_email; ?>
                                            </td>
                                            <td>
                                                <?= $cntct_prsn_watsapp; ?>
                                            </td>
                                            <!-- <td>
                                                <?= $stalls_3x3; ?>
                                            </td>
                                            <td>
                                                <?= $stalls_3x2; ?>
                                            </td> -->
                                            <td>
                                                <?= $status; ?>
                                            </td>
                                            <td>
                                                <?= $date; ?>
                                            </td>
                                            <td>

                                            <img src="data:image/jpg;charset=utf8;base64,<?= $logo; ?>" height="70vh">
                                                <!-- <?= $logo; ?> -->

                                            </td>
                                            <td>
                                                <?= $fascia; ?>
                                            </td>
                                            <td>
                                                <?= $remarks; ?>
                                            </td>
                                            <td>
                                                <div class='dropdown d-inline-block'>
                                                    <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        <i class='ri-more-fill align-middle'></i>
                                                    </button>
                                                    <ul class='dropdown-menu dropdown-menu-end'>
                                                        <!-- <li>
                                                            <a href='editstall_registration.php?id=$id' class='dropdown-item edit-item-btn'>
                                                                <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href='deletesocial.php?id=$id' class='dropdown-item remove-item-btn'>
                                                                <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Approve
                                                            </a>
                                                        </li> -->
                                                        <li>
                                                            <a href='deletestall_registration.php?id=<?= $id ?>' class='dropdown-item remove-item-btn'>
                                                                <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php  }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <?php include "footer.php"; ?>

    <script>
        function exportTableToExcel(example, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(example);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';
            // Create download link element
            downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);
            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                // Setting the file name
                downloadLink.download = filename;
                //triggering the function
                downloadLink.click();
            }
        }
    </script>