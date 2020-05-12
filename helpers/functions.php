<?php
  function Redirect_to($location){
    header("Location:".$location);
    exit;
  }

  function Shorten($string, $length) {
    if(strlen($string) <= $length) {
      echo $string;
    } else {
      $shortend_string = substr($string, 0, $length).'...';
      echo $shortend_string;
    }
  }

 ?>
