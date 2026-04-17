<?php

class validateData{

  public static function EmptyData()
  {
    return (!isset($_SESSION['username'])) ? true : false;
  }

}
?>