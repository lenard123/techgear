<?php

namespace App\Utils;

use Cloudinary\Cloudinary;

class Storage
{

  const DEFAULT_IMAGE = 'assets\\img\\product-default.jpg';

  public static function uploadImage($key, $dir = '') : string
  {

    /**
     * Return default image if 
     * the uploaded file is not a
     * valid Image
     */
    if (!self::isValidImage($key)) 
      return self::DEFAULT_IMAGE;


    /**
     * Upload to cloudinary if enabled
     **/
    if (config('storage.cloudinary_enabled'))
      return self::uploadImage2Cloudinary($key, $dir);


    //Upload file to storage folder by default
    return self::uploadImage2Local($key, $dir);
  }

  private static function uploadImage2Cloudinary($key)
  {
    try {
      //Base64 File
      $image = base64_encode(file_get_contents($_FILES[$key]['tmp_name']));

      $config = config('storage.cloudinary_url');
      $cloudinary = new Cloudinary($config);
      $result = $cloudinary->uploadApi()->upload('data:image/gif;base64,'.$image, ['folder' => config('storage.cloudinary_folder')]);

      return $result['secure_url'];
    } catch (\Exception $ex) {
      return self::DEFAULT_IMAGE;
    }
  }

  private static function uploadImage2Local($key, $dir)
  {
    //Add trailing slashes
    if (!empty($dir)) $dir = $dir . '\\';
    
    //Get File Target
    $filename = time() . '.' . self::getExtension($key);
    $targetLocation = self::getTargetLocation($key, $dir) . $filename;
    
    $tmp = $_FILES[$key]['tmp_name'];

    if (move_uploaded_file($tmp, $targetLocation)) {
      return 'storage\\uploads\\'. $dir . $filename;
    } else {
      return self::DEFAULT_IMAGE;
    }
  }

  private static function getTargetLocation($key, $dir)
  {
    return ROOT_PATH . "\\public\storage\\uploads\\{$dir}";
  }

  private static function getExtension($key)
  {
    $pathinfo = pathinfo( $_FILES[$key]['name']  , PATHINFO_EXTENSION);
    return strtolower($pathinfo);
  }

  private static function isValidImage($key)
  {
    if(!file_exists($_FILES[$key]['tmp_name']) || !is_uploaded_file($_FILES[$key]['tmp_name'])) {
      return false;
    }
    return true;
  }

}