
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
  <div class="container-fluid d-flex align-items-center justify-content-between position-relative">
     <?php
      $targetDate = '2023-11-01';

      // Get the current date and time
      $currentDateTime = new DateTime();

      // Create a DateTime object for the target date
      $targetDateTime = new DateTime($targetDate);

      // Calculate the difference between the current date/time and the target date/time
      $timeRemaining = $currentDateTime->diff($targetDateTime);

      // Get the individual components of the time remaining
      $daysRemaining = $timeRemaining->days;
      $hoursRemaining = $timeRemaining->h;
      $minutesRemaining = $timeRemaining->i;
      $secondsRemaining = $timeRemaining->s;


      ?>

     <div class="logo">
       <!-- <h1 class="text-light"><a href="index.html"><span>KLIBF</span></a></h1> -->
       <!-- Uncomment below if you prefer to use an image logo -->
       <!-- <a href="index.php"><img src="assets/img/Logo_02.png" alt="" class="img-fluid"></a> -->
     </div>
     <!-- <div class="animated flipInX infinite slower text-center">
       <span style="font-size: 35px; color: white; font-weight: 900;">
         <?php echo  $daysRemaining; ?><br>
         <p style="font-size: 15px; color: white; font-weight: 500;">Days to Go</p>
          <p style="font-size: large; color: white; font-weight: 500;">09-01-2023</p> 
       </span>
     </div> -->
     <!-- <nav class="text-center count">

       <?php echo  $daysRemaining; ?><br>
       <p>Days to Go</p>
       

     </nav> -->

     <?php include "menu-inner.php"; ?>


   </div>
  </header>
  <!-- End Header -->