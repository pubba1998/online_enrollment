
<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Otago Polytech</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>

</head>
<body>

<!-- <div class="container">

  <div class="header">

    <div class="menu">

    <ul>

    <li><a class="active" href="StudentPage.php">HOME</a></li>

      <li><a href="LecturePage.php">Student</a></li>

      <li><a href="EnrollmentPage.php">Enrollment</a></li>


    </ul>

    </div>



  </div> -->



<div class="container mt-3">
  <h2>Toggleable Tabs</h2>
  <br>
  <!-- Nav tabs -->
   <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#student">Student</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#lecturer">Lecturer</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Module</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#enrollment">Enrollment</a>
    </li>
  </ul>

  <!-- Tab panes -->
 <div class="tab-content">
    <div id="student" class="container tab-pane active"><br>
     <?php include('StudentPagePage.php') ?>
      <!-- <a href="StudentPage.php">Student</a> -->
      </div>
    <div id="lecturer" class="container tab-pane fade"><br>
    <?php include('LecturePage.php') ?>
      </div>
    <div id="menu2" class="container tab-pane fade"><br>
    <!-- <?php include('ModulePagePage.php') ?> -->
      </div>
      <div id="enrollment" class="container tab-pane fade"><br>
      <!-- <?php include('EnrollmentPage.php') ?> -->
  </div>

</div>


<!-- </div>  -->

</body>
</html>

