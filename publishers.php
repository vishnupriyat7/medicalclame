<!DOCTYPE html>
<html lang="en">

<?php include "head-style.php"; ?>
<?php include "config.php"; ?>
<style>
  #example {
    width: 60%;
    margin-left: auto;
    margin-right: auto;
  }

  #example th {
    font-size: medium;
    font-weight: bold;
  }

  .container {
    text-align: center;
  }

  .pagination {
    display: flex;
    align-items: center;
    justify-content: center;

    /* padding: 10px; */
    border-radius: 5px;
  }

  .pagination a {
    background: rgba(111, 153, 32, 0.9);
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
  }

  .logo-popup {
    cursor: pointer;
  }

  .popup-container {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60%;
    height: 70%;
    background: rgba(0, 0, 0, 0.8);
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  .popup-image {
    max-width: 100%;
    max-height: 100%;
    margin: auto;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    color: #fff;
    font-size: 30px;
  }



  .modal {
    justify-content: center;
    align-items: center;
  }

  @media (max-width: 576px) {
    .modal-dialog {
      max-width: 90%;
    }
  }

  @media (max-width: 768px) {
    .pagination {
      flex-direction: column;
      align-items: center;
    }

    #pageNumbers {
      margin: 10px 0;
    }

    #prev,
    #next {
      margin-top: 10px;
    }
  }
</style>



<body>

  <!-- ======= Header ======= -->
  <?php include "header-inner.php"; ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Publisher</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Publisher</li>
          </ol>
        </div>

      </div>
    </section>
    <!-- End Breadcrumbs Section -->
    <div class="container shadow min-vh-100 py-4">
      <div class="row mt-2">
        <div class="col-md-5 mx-auto">
          <div class="input-group">
            <input class="form-control border rounded-pill" type="search" placeholder="Search" id="search-input">
          </div>
        </div>
      </div>
      <section class="inner-page">
        <div class="container">
          <div class="table-responsive">
            <table id="example" class="table table-light table-bordered table-hover">
              <thead>
                <tr>
                  <th data-ordering="false">Sl.No</th>
                  <th data-ordering="false">Logo</th>
                  <th data-ordering="false">Publisher Name</th>
                  <th data-ordering="false">Catalogue</th>
                </tr>
              </thead>
              <tbody id="table-body">
                <?php
                $query = "SELECT up.id, up.user_id, up.fascia, up.logo, ch.user_id, ch.status FROM users_profile up JOIN challan ch ON up.user_id = ch.user_id WHERE ch.status = 'A' ORDER BY up.fascia ASC";
                $publshrdetls = mysqli_query($conn, $query);
                $counter = 0;
                while ($publshr = mysqli_fetch_array($publshrdetls)) {
                  $id = "$publshr[id]";
                  $pub_user_id = "$publshr[user_id]";
                  $org_name = "$publshr[fascia]";
                  $logo = base64_encode($publshr['logo']);
                ?>
                  <tr>
                    <td>
                      <?= ++$counter; ?>
                    </td>
                    <td>
                      <!-- <img src="data:image/jpg;charset=utf8;base64,<?= $logo; ?>" height="80vh" width="95vw"> -->
                      <!-- <?= $logo; ?> -->
                      <!-- <div class="logo-popup" onclick="preloadAndShowPopup('<?= $logo; ?>');" on="hidePopup();">
                        <img src="data:image/jpg;charset=utf8;base64,<?= $logo; ?>" height="80vh" width="95vw">
                      </div> -->
                      <div class="logo-popup" onclick="showPopup('<?= $logo; ?>');">
                        <img src="data:image/jpg;charset=utf8;base64,<?= $logo; ?>" height="80vh" width="95vw">
                      </div>
                    </td>


                    <td>
                      <?= $org_name; ?>
                    </td>
                    <td>
                      <?php
                      $sql1 = "SELECT * FROM publisher_catalogue WHERE user_id = ?";
                      $stmt1 = $conn->prepare($sql1);
                      $stmt1->bind_param("i", $pub_user_id);
                      $stmt1->execute();
                      $result1 = $stmt1->get_result();
                      $publsr_catalogue = $result1->fetch_assoc();
                      // var_dump($result1);
                      $filename = "$publsr_catalogue[filename]";
                      $file_dir = 'catalogue/';
                      // var_dump($filename);
                      if ($filename) {
                        $file = $file_dir . '/' . $filename;
                      ?>

                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal<?= $pub_user_id ?>">View</button>
                        <div class="modal" id="myModal<?= $pub_user_id ?>">
                          <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title"><?= $org_name; ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <div class="modal-body">
                                <div class="embed-responsive embed-responsive-16by9">
                                  <iframe src="<?= $file; ?>" class="embed-responsive-item" width="100%" height="700px"></iframe>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } else {
                        echo '';
                      }
                      ?>
                      <!-- <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">View</button> -->
                    </td>
                  </tr>
                <?php  }  ?>
              </tbody>
            </table>
          </div>
        </div>

      </section>
      <div class="popup-container" id="popupContainer">
        <span class="close-button" onclick="hidePopup();">&times;</span>
        <img class="popup-image" id="popupImage" src="" alt="Logo">
      </div>
    </div>



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include "footer.php" ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#search-input').on('input', function() {
        var searchText = $(this).val().toLowerCase();
        $('#table-body tr').filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
        });
      });
    });

    function showPopup(imageData) {
      const popupContainer = document.getElementById('popupContainer');
      const popupImage = document.getElementById('popupImage');
      popupImage.src = `data:image/jpg;charset=utf8;base64,${imageData}`;
      popupContainer.style.display = 'block';
    }

    function hidePopup() {
      const popupContainer = document.getElementById('popupContainer');
      popupContainer.style.display = 'none';
    }
  </script>


</body>

</html>