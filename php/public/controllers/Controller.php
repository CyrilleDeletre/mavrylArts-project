<?php

/**
 * Inclusion du fichier BddConnect.php
 */
require_once dirname(__DIR__) . '/models/BddConnect.php';

/**
 * Classe Controller
 */
class Controller
{
    public $model;

    /**
     * Constructeur de la classe Controller
     */
    public function __construct()
    {
        // Initialisation de la propriété $model avec une nouvelle instance de BddConnect
        $this->model = new BddConnect();
    }

    /**
     * Controller pour afficher la view de base
     */
    function index()
    {
        // Inclusion du fichier base.php depuis le dossier views
        require_once dirname(__DIR__) . "/views/base.php";
    }

    /**
     * Controller pour insérer un message dans la base de données
     * 
     * @param string $lastName Le nom de famille du message
     * @param string $firstName Le prénom du message
     * @param string $email L'email du message
     * @param string $messageCategory La catégorie du message
     * @param string $messageContent Le contenu du message
     * @return bool
     */
    public function insertMessage($lastName, $firstName, $email, $messageCategory, $messageContent)
    {
        return $this->model->insertMessage($lastName, $firstName, $email, $messageCategory, $messageContent);
    }

    /**
     * Controller pour ajouter une image dans la base de données
     * 
     * @param string $path_img Le chemin de l'image
     * @param string $title_img Le titre de l'image
     * @return bool
     */
    public function addImage($path_img, $title_img)
    {
        return $this->model->addImage($path_img, $title_img);
    }

    /**
     * Controller pour récupérer toutes les images depuis la base de données
     * 
     * @return array
     */
    public function getAllImages()
    {
        return $this->model->getAllImages();
    }

    /**
     * Controller pour supprimer une image de la base de données
     * 
     * @param int $id_img L'ID de l'image à supprimer
     * @return bool
     */
    public function deleteImage($id_img)
    {
        return $this->model->deleteImage($id_img);
    }

    /**
     * Controller pour récupérer tous les messages depuis la base de données
     * 
     * @return array
     */
    public function getAllMessages()
    {
        return $this->model->getAllMessages();
    }

    /**
     * Controller pour récupérer un utilisateur par son ID depuis la base de données
     * 
     * @param int $user_id L'ID de l'utilisateur
     * @return array
     */
    public function getUserById($user_id)
    {
        return $this->model->getUserById($user_id);
    }

    /**
     * Controller pour supprimer un message de la base de données
     * 
     * @param int $id_message L'ID du message à supprimer
     * @return bool
     */
    public function deleteMessage($id_message)
    {
        return $this->model->deleteMessage($id_message);
    }

    /**
     * Controller pour récupérer tous les utilisateurs depuis la base de données
     * 
     * @return array
     */
    public function getAllUsers()
    {
        return $this->model->getAllUsers();
    }

    /**
     * Controller pour supprimer un utilisateur de la base de données
     * 
     * @param int $user_id L'ID de l'utilisateur à supprimer
     * @return bool
     */
    public function deleteUser($user_id)
    {
        return $this->model->deleteUser($user_id);
    }

    /**
     * Controller pour mettre à jour le mot de passe d'un utilisateur dans la base de données
     * 
     * @param string $email L'email de l'utilisateur
     * @param string $new_password Le nouveau mot de passe de l'utilisateur
     * @return bool
     */
    public function updatePassword($email, $new_password)
    {
        return $this->model->updatePassword($email, $new_password);
    }
}

?>
