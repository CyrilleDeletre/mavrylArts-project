<?php

require_once dirname(__DIR__) . '/models/BddConnect.php';

class Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new BddConnect();
    }

    function index()
    {
        require_once dirname(__DIR__) . "/views/base.php";
    }

    public function insertMessage($lastName, $firstName, $email, $messageCategory, $messageContent)
    {
        return $this->model->insertMessage($lastName, $firstName, $email, $messageCategory, $messageContent);
    }

    public function addImage($path_img, $title_img)
    {
        return $this->model->addImage($path_img, $title_img);
    }

    public function getAllImages()
    {
        return $this->model->getAllImages();
    }

    public function deleteImage($id_img)
    {
        return $this->model->deleteImage($id_img);
    }

    public function getAllMessages()
    {
        return $this->model->getAllMessages();
    }

    public function getUserById($user_id)
    {
        return $this->model->getUserById($user_id);
    }

    public function deleteMessage($id_message)
    {
        return $this->model->deleteMessage($id_message);
    }

    public function getAllUsers()
    {
        return $this->model->getAllUsers();
    }

    public function deleteUser($user_id)
    {
        return $this->model->deleteUser($user_id);
    }

    public function updatePassword($email, $new_password)
    {
        return $this->model->updatePassword($email, $new_password);
    }
}



