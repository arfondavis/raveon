<?php
	require('../settings/db.php');
	include("auth.php");
  if(isset($_GET['pe'])){
    $sql = "SELECT * FROM pod_list WHERE id = ".$_GET['pe'];
    if(!$result = $db->query($sql)){
      die('There was an error running the query [' . $db->error . ']');
    }
  }
  if(isset($_POST['editep'])){
    $id = $_GET['pe'];
    if($_POST['podcastLive'] == 'on'){
      $pod_live = '1';
    }else{
      $pod_live = '0';
    }
    $ep_title = filter_var($_POST["episodeTitle"], FILTER_SANITIZE_STRING);
    $ep_desc = str_replace("'", "&#39;", $_POST["episodeDiscription"]);
    $ep_date = $_POST["dateInput"];
    $ep_duration = $_POST["timeInput"];
    $ep_mixcloud = $_POST["mixcloudInput"];

    $update_enq = "UPDATE pod_list SET title='$ep_title', description='$ep_desc', duration='$ep_duration', mixcloud_url='$ep_mixcloud', date='$ep_date', live='$pod_live' WHERE id=$id";

    if ($db->query($update_enq) === TRUE) {
      header("Location:edit.php?pe=$id&updated");
    } else {
      echo "Error: " . $update_enq . "<br>" . mysqli_error($db);
    }
  }
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="The place where all of DJ Raveon's podcasts can be found.">
<meta name="author" content="Arfon Davis">

<title>DJ Raveon's Podcast Show</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="../css/offcanvas.css" rel="stylesheet">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
<?php include_once('settings/fav.php'); ?>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="#">DJ Raveon's Podcast Show</a>
  <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
<div class="nav-scroller bg-white box-shadow">
  <nav class="nav nav-underline">
    <a class="nav-link" href="index.php"><i class="fa fa-caret-left"></i> Back</a>
  </nav>
</div>
<?php if(isset($_GET['updated'])){?>
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
  <i class="far fa-thumbs-up mr-3"></i>Title, Description, Date, Duration and Mixcloud link <strong>updated</strong><i class="far fa-thumbs-up ml-3"></i>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php }?>
<main role="main" class="container">
  <?php include_once('shared/logo.php'); ?>
  <?php 
    while($row = $result->fetch_assoc()){
  ?>
  <div class="my-3 p-3 bg-white rounded box-shadow">
    <h6 class="border-bottom border-gray pb-2 mb-0">Edit <?php echo $row['title'];?></h6>
    <div class="text-muted pt-3">
      <form action="" method="post" name="editepisode">
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="podLive" name="podcastLive"<?php if($row['live'] == '1'){?> checked="checked"<?php }?>>
              <label class="form-check-label" for="podLive">Live?</label>
          </div>
        </div>
        <div class="form-label-group">
          <label for="episodeTitle">Episode Title</label>
          <input type="text" id="episodeTitle" class="form-control form-control-lg" name="episodeTitle" placeholder="" required value="<?php echo $row['title'];?>">
        </div>
        <div class="form-group pt-2 mb-2">
          <label for="episodeDiscription">Episode Description</label>
          <textarea class="form-control" id="episodeDiscription" rows="3" placeholder="" name="episodeDiscription" required><?php echo $row['description'];?></textarea>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-label-group">
              <label for="dateInput">Date</label>
              <input type="text" id="dateInput" class="form-control form-control-lg" name="dateInput" placeholder="" required value="<?php echo $row['date'];?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-label-group">
              <label for="timeInput">Duration</label>
              <input type="text" id="timeInput" class="form-control form-control-lg" name="timeInput" placeholder="" required value="<?php echo $row['duration'];?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-label-group">
              <label for="mixcloudInput">Mixcloud</label>
              <input type="text" id="mixcloudInput" class="form-control form-control-lg" name="mixcloudInput" placeholder="" value="<?php echo $row['mixcloud_url'];?>">
            </div>
          </div>
          <div class="col-12 pt-3">
            <h5 id="tracks"><a href="edittracks.php?pe=<?php echo $row['id']?>">Edit Track Listings</a></h5>
          </div>
          <div class="col-12 pt-3">
            <button class="btn btn-dark" name="editep" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php } ?>
</main>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function(){
    function sendnewTxt(data){
      $.ajax({
        url: '',
        type: 'put',
        success: function success(){
          //$("#successtxt").removeClass("hidden").effect("slide", {"duration":"fast"}).delay(6000).effect("puff", {"duration":"slow"});
        },
        error: function error(a,b,c,d){
          /*
          $("#warningtxt").removeClass("hidden").effect("slide", {"duration":"fast"});
          $("#successtxt").removeClass("hidden").effect("puff", {"duration":"slow"});
          */
        },
        data: data
          });
    }
  });
</script>
<?php $db->close(); ?>
</body>
</html>