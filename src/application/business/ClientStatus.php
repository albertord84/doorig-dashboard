<?php

namespace business {
  
   /**
   * @category Business class
   * 
   * @access public
   *
   * @todo Define an UserStatus business static class.
   * 
   */
  class ClientStatus {

    const ACTIVE = 1;
    const CANCELED = 2;
    const DONT_DISTURB = 3;

    static public function Defines($const) {
      $cls = new ReflectionClass(__CLASS__);
      foreach ($cls->getConstants() as $key => $value) {
        if ($value == $const) {
          return true;
        }
      }

      return false;
    }

  }

}