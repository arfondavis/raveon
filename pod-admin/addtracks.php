<?php
	require('../settings/db.php');
	include("auth.php");
  $pod_id = $_POST["trackEID"]; 
  $insert_enq = "INSERT INTO podcasts_tracks (track_artist, track_title, podcast_id) VALUES ('', '', $pod_id)";

  if ($db->query($insert_enq) === TRUE) {
    echo "Saved";
  } else {
    echo "Error: " . $insert_enq . "<br>" . mysqli_error($db);
  }
?>