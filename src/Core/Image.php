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
                    echo "your file is too big";
                    return null;
                }
            } else {
                echo "there was an error uploading your file";
                return null;
            }
        } else {
            echo "you can't upload files of this type";
            return null;
        }

        return ['NameFile' => $NameFile, 'file' => $file];
    }
}
