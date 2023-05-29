<?php

namespace News\Core;

class Image
{
    public static function uploadImage()
    {
        $file = $_FILES['image'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        if (!$fileTmpName) {
            return null;
        }

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) {
                    $NameFile = uniqid() . "." . $fileActualExt;
                    $fileDestination = STORAGE . "images/$NameFile";
                    move_uploaded_file($fileTmpName, $fileDestination);
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } else {
            return null;
        }
        return ['NameFile' => $NameFile, 'file' => $file];
    }
}
