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

    public static function uploadCKEditorImage()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }

        if (isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['upload'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];

            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png'];

            if (in_array($fileExt, $allowed)) {
                if ($fileSize < 5000000) {
                    $uniqueFileName = uniqid() . '.' . $fileExt;
                    $fileDestination = STORAGE . "images/$uniqueFileName";

                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $url = BASE_URL . "storage/images/$uniqueFileName";
                        echo json_encode(['url' => $url]);
                        exit;
                    }
                } else {
                    echo json_encode(['error' => 'File size is too large']);
                    exit;
                }
            } else {
                echo json_encode(['error' => 'Invalid file type']);
                exit;
            }
        }

        echo json_encode(['error' => 'File upload failed']);
    }
}
