<?php

require_once dirname(__DIR__) . "/models/BddConnect.php";

class Controller
{
    function index()
    {
        require_once dirname(__DIR__) . "/views/base.php";
    }

    function insertContactData($lastName, $firstName, $email, $messageCategory, $messageContent)
    {
        $conn = new BddConnect;
        return $conn->insertMessage($lastName, $firstName, $email, $messageCategory, $messageContent);
    }

    function addImage($path_img, $title_img)
    {
        $conn = new BddConnect;
        return $conn->addImage($path_img, $title_img);
    }

    function getAllImages()
    {
        $conn = new BddConnect;
        return $conn->getAllImages();
    }

    function deleteImage($id_img)
    {
        $conn = new BddConnect;
        return $conn->deleteImage($id_img);
    }
}
?>
