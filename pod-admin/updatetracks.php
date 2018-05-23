<?php
	require('../settings/db.php');
	include("auth.php");
  $id = $_POST["trackID"]; 
  $artist = $_POST["artistInput"]; 
  $track = $_POST["trackInput"]; 
  $pod_id = $_POST["trackEID"]; 
  $update_enq = "UPDATE podcasts_tracks SET track_artist='$artist', track_title='$track', podcast_id='$pod_id' WHERE tracks_id=$id";

  if ($db->query($update_enq) === TRUE) {
    //header("Location:edittracks.php");
    echo "Saved";
  } else {
    echo "Error: " . $update_enq . "<br>" . mysqli_error($db);
  }
?>