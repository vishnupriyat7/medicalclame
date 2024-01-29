<!DOCTYPE html>
<html lang="en">

<?php include "head-style.php"; ?>



<body>

    <!-- ======= Header ======= -->
    <?php include "header-inner.php"; ?>
    <!-- End Header -->

    <main id="about-inner-main">

        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">


                <div class="d-flex justify-content-between align-items-center">
                    <h2>Schedule</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>Schedule</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs Section -->

        <section class="section d-flex align-items-center ptb_50">
            <div class="container">
                <div class="d-flex justify-content-end">
                    <!-- <a href="https://docs.google.com/forms/d/11d3YLOtjtA_osjraiAfxXyNvLuv2N14Om0dKEuGdJpY/edit" class="mr-2 btn btn-success" target="_blank"><i class="fa fa-download"></i> <span class="horizontal-shake">Click Here to Apply</a></span> -->
                    <!-- <a href="https://docs.google.com/forms/d/11d3YLOtjtA_osjraiAfxXyNvLuv2N14Om0dKEuGdJpY/edit" class="mr-2 btn btn-success horizontal-shake" target="_blank"><i class="fa fa-download"></i> Click Here to Apply</a> -->
                    <!-- <a href="https://www.youtube.com/watch?v=tIrV4JzbRF4&list=PLWnK7DhsuZ9CnwyahQsrezv_GYZbDlvQ8" class="mr-2 btn btn-success horizontal-shake" target="_blank"><i class="fa fa-download"></i> Entries</a> -->

                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success" data-bs-toggle="modal"  data-pdf-url="DAY-1.pdf">Day-1</button>&emsp;
                    <button class="btn btn-success" data-bs-toggle="modal"  data-pdf-url="DAY-2.pdf">Day-2</button>&emsp;
                    <button class="btn btn-success" data-bs-toggle="modal"  data-pdf-url="DAY-3.pdf">Day-3</button>&emsp;
                    <button class="btn btn-success" data-bs-toggle="modal"  data-pdf-url="DAY-4.pdf">Day-4</button>&emsp;
                    <button class="btn btn-success" data-bs-toggle="modal"  data-pdf-url="DAY-5.pdf">Day-5</button>&emsp;
                    <button class="btn btn-success" data-bs-toggle="modal"  data-pdf-url="DAY-6.pdf">Day-6</button>&emsp;
                    <button class="btn btn-success" data-bs-toggle="modal"  data-pdf-url="DAY-7.pdf">Day-7</button>&emsp;
                </div>
                <br>


                <div class="embed-responsive embed-responsive-16by9 text-center">
                    <iframe id="pdfFrame" class="embed-responsive-item" width="80%" height="800px"></iframe>
                </div>



            </div>
        </section>
    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <?php include "footer.php" ?>

    <script>
        // Get references to the buttons and the iframe
        const buttons = document.querySelectorAll('.btn-success[data-pdf-url]');
        const pdfFrame = document.getElementById('pdfFrame');

        // Add a click event listener to each button
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the PDF URL from the clicked button's data attribute
                const pdfUrl = this.getAttribute('data-pdf-url');
                // Set the iframe's src attribute to the selected PDF URL
                pdfFrame.src = pdfUrl;
            });
        });

        // Trigger a click event on the last button to open the last day's PDF by default
        buttons[buttons.length - 1].click();
    </script>



</body>

</html>