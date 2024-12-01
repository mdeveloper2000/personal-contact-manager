<?php

namespace App\Controllers;

header("Content-Type: application/json; charset=utf-8");
require($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "autoload.php");

use App\Database\ContactDAO;
use App\Helpers\UploadHelper;
use App\Models\Contact;

if($_SERVER["REQUEST_METHOD"] === "GET") {
    $action = filter_input(INPUT_GET, "action");
    if($action === "index") {
        $dao = new ContactDAO();
        echo json_encode($dao->list());
    }
    else if($action === "show") {
        $id = filter_input(INPUT_GET, "id");
        $dao = new ContactDAO();
        $contact = $dao->show($id);
        echo json_encode($contact);
    }
    else if($action === "search") {        
        $name = filter_input(INPUT_GET, "name");
        $dao = new ContactDAO();
        echo json_encode($dao->search($name));
    }
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = filter_input(INPUT_POST, "action");    
    if($action === "store") {
        $contact = new Contact();
        $name = filter_input(INPUT_POST, "name");
        $phone = filter_input(INPUT_POST, "phone");
        $email = filter_input(INPUT_POST, "email");
        $annotations = filter_input(INPUT_POST, "annotations");
        $contact->setName($name);
        $contact->setPhone($phone);
        $contact->setEmail(strtolower($email));
        $contact->setAnnotations($annotations);
        $photo = $_FILES["photo"];
        if(UploadHelper::hasFile($photo) && UploadHelper::sizeLimits($photo)) {            
            $mime = $photo["type"];
            if(UploadHelper::checkExtension($mime)) {
                $filename = UploadHelper::generateFilename($mime);                
                if(move_uploaded_file($_FILES["photo"]["tmp_name"], PHOTO_UPLOADS . $filename)) {
                    $contact->setPhoto($filename);
                }
            }
        }
        else {
            $contact->setPhoto("");
        }        
        $dao = new ContactDAO();
        echo json_encode($dao->store($contact));        
    }
    if($action === "update") {
        $contact = new Contact();
        $id = filter_input(INPUT_POST, "id");
        $name = filter_input(INPUT_POST, "name");
        $phone = filter_input(INPUT_POST, "phone");
        $email = filter_input(INPUT_POST, "email");
        $annotations = filter_input(INPUT_POST, "annotations");
        $currentPhoto = filter_input(INPUT_POST, "currentPhoto");
        if($currentPhoto !== "") {
            $contact->setPhoto($currentPhoto);
        }
        else {
            $contact->setPhoto("");
        }
        if(isset($_FILES["photo"]) && !empty($_FILES["photo"])) {
            $photo = $_FILES["photo"];
            if(UploadHelper::hasFile($photo) && UploadHelper::sizeLimits($photo)) {            
                $mime = $photo["type"];
                if(UploadHelper::checkExtension($mime)) {
                    $filename = UploadHelper::generateFilename($mime);                    
                    if(move_uploaded_file($_FILES["photo"]["tmp_name"], PHOTO_UPLOADS . $filename)) {
                        $contact->setPhoto($filename);
                        $path = PHOTO_UPLOADS . $currentPhoto;                        
                        if($currentPhoto !== "") {
                            UploadHelper::deleteFile($path);
                        }                        
                    }
                }
            }            
        }
        $contact->setId($id);
        $contact->setName($name);
        $contact->setPhone($phone);
        $contact->setEmail(strtolower($email));
        $contact->setAnnotations($annotations);
        $dao = new ContactDAO();
        echo json_encode($dao->update($contact));
    }
    else if($action === "delete") {        
        $id = filter_input(INPUT_POST, "id");
        $dao = new ContactDAO();
        $photo = $dao->getPhoto($id);
        if($dao->destroy($id)) {
            if($photo !== "") {                
                $path = PHOTO_UPLOADS . $photo;
                UploadHelper::deleteFile($path);                
            }
            echo json_encode(true);
        }
        else {
            echo json_encode(false);
        }
    }
}