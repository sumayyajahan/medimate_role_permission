<?php

namespace App\Helpers;

use App\Models\Notification;
use Image;
use File;

class FileHelper
{        
    /**
     * uploadProductImage
     *
     * @param  Object $request
     * @param  mixed $product
     * @return string
     */
    public static function uploadProductImage($request, $product = NULL)
    {
        $imageName = "";
        if ($request->hasFile('image')) {


            if ($product != NULL) {
                $imageName = $product->image;
                FileHelper::deleteProductImage($imageName);

            }

            $image = $request->file('image');
            $imageName = time() . uniqid() . '.' . $image->getClientOriginalExtension();


            // Image::make($image)->save('product/' . $imageName);
            Image::make($image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/' . $imageName, 50);
        }
        return $imageName;
    }


    /**
     * uploadImage
     *
     * @param  Object $request
     * @param  mixed $user
     * @return void
     */
    public static function uploadImage($request, $user = NULL)
    {
        $imageName = "";
        if ($user != NULL) {
            $imageName = $user->image;
        }

        if ($request->hasFile('image')) {

            FileHelper::deleteImage($user);
            $image = $request->file('image');
            $imageName = time() . uniqid() . '.' . $image->getClientOriginalExtension();


            // Image::make($image)->save('images/' . $imageName);
            Image::make($image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/' . $imageName, 50);
        }
        return $imageName;
    }
    public static function uploadFile($request, $user = NULL)
    {
        $fileName = "";
        if ($user != NULL) {
            $fileName = $user->file;
        }
        if ($request->hasFile('file')) {

            if ($user != NULL) {
              FileHelper::deleteFile($user);
            }
            $file = $request->file('file');
            $fileName = time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('files', $fileName);
        }
        return $fileName;
    }


    public static function deleteFile($user)
    {
        if ($user != NULL) {
            if (File::exists('files/' . $user->file)) {
                File::delete('files/' . $user->file);
            }
        }
    }

    public static function deleteImage($user)
    {
        if ($user != NULL) {
            if (File::exists('images/' . $user->image)) {
                File::delete('images/' . $user->image);
            }
        }
    }

    public static function deleteProductImage($imageName)
    {
        if ($imageName != NULL) {
            if (File::exists('product/' . $imageName)) {
                File::delete('product/' . $imageName);
            }
        }
    }
    
    /**
     * userNotify
     *
     * @param  int $id
     * @param  String $title
     * @param  String $message
     * @return void
     */
    public static function userNotify($id,$title,$message)
    {
        $notify = new Notification();
        $notify->user_id = $id;
        $notify->title =  $title;
        $notify->body = $message;
        $notify->save();
    }

    public static function doctorNotify($id,$title,$message)
    {
        $notify = new Notification();
        $notify->doctor_id = $id;
        $notify->title =  $title;
        $notify->body = $message;
        $notify->save();
    }

    public static function pharmacyNotify($id,$title,$message)
    {
        $notify = new Notification();
        $notify->pharmacy_id = $id;
        $notify->title =  $title;
        $notify->body = $message;
        $notify->save();
    }
    public static function serviceNotify($id,$title,$message)
    {
        $notify = new Notification();
        $notify->service_provider_id = $id;
        $notify->title =  $title;
        $notify->body = $message;
        $notify->save();
    }
}
