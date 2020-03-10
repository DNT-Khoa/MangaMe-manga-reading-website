<?php
  function Redirect_to($location){
    header("Location:".$location);
    exit;
  }

 ?>
