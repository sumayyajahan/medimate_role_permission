<?php
namespace App\Helpers;

class UploadImage{
    public static function image_upload($file)
    {
        $fileType=$file->getClientOriginalExtension();
        $fileName=rand(1,1000).date('dmyhis').".".$fileType;
        $file->move('images',$fileName);
        return $fileName;
    }

    public static function image_delete($file_name){
        $file_path='images/'.$file_name;
            if($file_name!=null and file_exists($file_path)){
                unlink($file_path);
            }
    }
}
