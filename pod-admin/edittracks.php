<?php
	require('../settings/db.php');
	include("auth.php");
  if(isset($_GET['pe'])){
    $sql = "SELECT * FROM podcasts_tracks WHERE podcast_id = ".$_GET['pe'];
    if(!$result = $db->query($sql)){
      die('There was an error running the query [' . $db->error . ']');
    }
  }
  // Removes the id row from the db

  if(isset($_POST['deltrack'])){
    $trackid = $_POST['trackID'];
    $id = $_GET['pe'];
    $query_del = "DELETE FROM podcasts_tracks WHERE tracks_id=$trackid";
    if ($db->query($query_del) === TRUE) {
      header("Location:edittracks.php?pe=$id&tracks=del");
    } else {
      echo "Error: " . $query_del . "<br>" . mysqli_error($db);
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
  <i class="far fa-thumbs-up mr-3"></i>Tracklist <strong>updated</strong><i class="far fa-thumbs-up ml-3"></i>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php }?>
<main role="main" class="container">
  <?php include_once('shared/logo.php'); ?>
  <div class="my-3 p-3 bg-white rounded box-shadow" id="tracks">
    <?php if(isset($_GET['tracks']) && $_GET['tracks'] == 'del'){ ?>
      <div class="col-12">
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
          <i class="far fa-thumbs-up mr-3"></i>Track <strong>removed</strong><i class="far fa-thumbs-up ml-3"></i>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    <?php } ?>
    <div class="col-12 pt-3">
      <h5 id="tracks">Track Listings</h5>
    </div>
      <div class="row mb-3">
        <div class="col-md-6"><h6>Artist</h6></div>
        <div class="col-md-5"><h6>Track</h6></div>
        <div class="col-md-1"><form action="" method="post" id="newtrack" name="newtrackfprm"><button class="btn btn-outline-success btn-sm" id="nt" name="newtrack" type="button"><i class="fa fa-plus"></i></button><input type="hidden" value="<?php echo $_GET['pe']?>" name="trackEID"></form></div>
      </div>
      <?php 
        $i=1;
        while($row = $result->fetch_assoc()){
      ?>
      <form action="" method="post" id="editept" name="editepisodetracks">
        <div class="row">
          <div class="col-md-6">
            <div class="form-label-group" data-row="<?php echo $row['tracks_id'] ?>">
              <input type="text" id="artistInput<?php echo $i?> trackArtist" class="form-control form-control-lg trackArtist" name="artistInput" placeholder="" value="<?php echo $row['track_artist'] ?>">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-label-group" data-row="<?php echo $row['tracks_id'] ?>">
              <input type="text" id="trackInput<?php echo $i?> trackTitle" class="form-control form-control-lg trackTitle" name="trackInput" placeholder="" value="<?php echo $row['track_title']?>">
            </div>
          </div>
          <div class="col-md-1">
            <button class="btn btn-danger" name="deltrack" type="submit"><i class="fas fa-minus-circle"></i></button>
            <input type="hidden" value="<?php echo $row['tracks_id']?>" name="trackID">
            <input type="hidden" value="<?php echo $row['podcast_id']?>" name="trackEID">
          </div>
        </div>
      </form>
      <?php 
      $i++;
      } 
      ?>
  </div>
</main>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();
    $("input").keyup(function() {
      var form = $(this.form);
      delay(function(){
        $.ajax({
          url: "updatetracks.php",
          method: "POST",
          data: form.serialize(),
          success: function(data){
            $(form).notify(
              "Updated",
              {
                position:"top",
                className: 'success',
              }
            );
          }
        }) // end of ajax
      }, 900); // end of delay
    }); // end of $("#input").keyup
    $("#nt").click(function() {
      var form = $(this.form);
      $.ajax({
        url: "addtracks.php",
        method: "POST",
        data: form.serialize(),
        success: function(data){
          location.reload();
        }
      }); // end of ajax
    }); // end of $("#input").keyup
  }); // end of $(document).ready
</script>
<?php $db->close(); ?>
</body>
</html>