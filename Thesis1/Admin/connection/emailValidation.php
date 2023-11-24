<?php
//use this function to verify email address at signup.php pass the value of the email input for the parameters
  $email = 'asdasdaasdas';
  

  // using FILTER_VALIDATE_EMAIL - this is the best option to use in PHP
  function isValidEmail($email)
  {
   if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
         return true;
   }
   else {
    return false;
   }
  }



?>