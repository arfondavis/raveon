<?php
	require('../settings/db.php');
	include("auth.php");

  if(isset($_POST['artistInput'])){
    echo "YES";
  }else{
    echo "NO!!!";
  }
/*
  $update_enq = "UPDATE pod_list SET title='$ep_title', description='$ep_desc', duration='$ep_duration', mixcloud_url='$ep_mixcloud', date='$ep_date', live='$pod_live' WHERE id=$id";

  if ($db->query($update_enq) === TRUE) {
    header("Location:edit.php?pe=$id&updated");
  } else {
    echo "Error: " . $update_enq . "<br>" . mysqli_error($db);
  }
*/
?>