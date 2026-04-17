<?php
class envInfo{
  // 1 = Major
  // 0 = Minor
  // 0 = Patch 
  public static $version = "1.0.0";
  public static function currentVersion()
  {
    return self::$version;
  }

}
?>