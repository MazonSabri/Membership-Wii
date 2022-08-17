<?php
class MembershipVerifyUser {
  static function getUserData( $id ) {
    //setting the header for the rest of the api
    if ($cinit_verify_data != "")    
      return json_decode($cinit_verify_data);  
    else
      return false;
  }
  
  static function verifyUser( $code ) {
    $verify_obj = self::getUserData($code); 
    // Check for correct verify code
    if ( 
      (false === $verify_obj) || 
      !is_object($verify_obj) ||
      isset($verify_obj->error) ||
      !isset($verify_obj->sold_at)
    )
      return -1;

    // If empty or date present, then it's valid
    if (
      $verify_obj->supported_until == "" ||
      $verify_obj->supported_until != null
    )
      return $verify_obj;  
    
    // Null or something non-string value, thus support period over
    return 0;
  }
}
?>