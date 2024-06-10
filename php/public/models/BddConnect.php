<?php
/**
 * Classe pour la connexion à la base de données.
 */
class BddConnect
{
    public $connexion;

    /**
     * Constructeur de la classe BddConnect.
     */
    public function __construct()
    {
        $user = "root";
        $password = "root";
        $bdd = "mavrylArts";
        $server = "mysql:host=mysql;dbname=$bdd";

        try {
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            );
            $this->connexion = new PDO($server, $user, $password, $options);
        } catch (PDOException $e) {
            error_log("Erreur de connexion : " . $e->getMessage(), 0);
            throw new Exception("Erreur de connexion à la base de données.");
        }
    }

    /**
     * Méthode pour insérer un message dans la base de données.
     * @param string $lastName Le nom du destinataire du message.
     * @param string $firstName Le prénom du destinataire du message.
     * @param string $email L'adresse email du destinataire du message.
     * @param string $messageCategory La catégorie du message.
     * @param string $messageContent Le contenu du message.
     * @return bool Retourne true si l'insertion a réussi, sinon false.
     */
    public function insertMessage($lastName, $firstName, $email, $messageCategory, $messageContent)
    {
        try {
            // On utilise la méthode beginTransaction afin de pouvoir envoyer des données à la BDD en 2 temps selon une série d'opérations
            $this->connexion->beginTransaction();
    
            $sql_check_user = "SELECT user_id, id_admin FROM users WHERE user_email = ?";
            $stmt_check_user = $this->connexion->prepare($sql_check_user);
            $stmt_check_user->execute([$email]);
            $existing_user = $stmt_check_user->fetch(PDO::FETCH_ASSOC);
    
            // D'abord, on vérifie si l'utilisateur existe déjà dans la BDD
            if ($existing_user) {
                $user_id = $existing_user['user_id'];
                $id_admin = $existing_user['id_admin'];
    
                // Si l'utilisateur est un admin et qu'il commence son message par "connexion" :
                // Alors dans ce cas on est redirigé vers l'espace de connexion sans publier de message
                if ($id_admin == 1 && strpos(strtolower($messageContent), 'connexion') === 0) {
                    header("Location: ?page=login");
                    exit();
                }
            } else {
                // S'il n'existe pas dans la BDD on ajoute un nouvel utilisateur dans la BDD avant de publier le message
                $sql_insert_user = "INSERT INTO users (user_first_name, user_last_name, user_email) VALUES (?, ?, ?)";
                $stmt_insert_user = $this->connexion->prepare($sql_insert_user);
                $stmt_insert_user->execute([$firstName, $lastName, $email]);
                
    
                $user_id = $this->connexion->lastInsertId();
            }
    
            // Ensuite, on ajoute le message dans la BDD selon l'id de l'utilisateur
            $sql_insert_message = "INSERT INTO message (message_category, message_content, user_id) VALUES (?, ?, ?)";
            $stmt_insert_message = $this->connexion->prepare($sql_insert_message);
            $stmt_insert_message->execute([$messageCategory, $messageContent, $user_id]);
    
            $this->connexion->commit();
    
            return true;
            
        } catch (Exception $e) {
            $this->connexion->rollBack();
            error_log("Échec de l'envoi du message : " . $e->getMessage(), 0);
            echo "Échec de l'envoi du message : " . $e->getMessage(); // Afficher l'erreur
            return false;
        }
    }
    
    
    /**
     * Méthode pour ajouter une image à la galerie.
     * @param string $path_img Le chemin de l'image.
     * @param string $title_img Le titre de l'image.
     * @return bool Retourne true si l'ajout a réussi, sinon false.
     */
    public function addImage($path_img, $title_img)
    {
        try {
            $sql_insert_image = "INSERT INTO gallery (path_img, title_img) VALUES (?, ?)";
            $stmt_insert_image = $this->connexion->prepare($sql_insert_image);
            $stmt_insert_image->execute([$path_img, $title_img]);
            return true;
        } catch (Exception $e) {
            error_log("Échec d'ajout d'image : " . $e->getMessage(), 0);
            return false;
        }
    }

    /**
     * Méthode pour lire toutes les images de la galerie
     */
    public function getAllImages()
    {
        try {
            $sql_select_images = "SELECT * FROM gallery";
            $stmt_select_images = $this->connexion->prepare($sql_select_images);
            $stmt_select_images->execute();
            return $stmt_select_images->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Échec de la récupération des images : " . $e->getMessage(), 0);
            return [];
        }
    }

    /**
     * Méthode pour supprimer une image de la galerie
     */
    public function deleteImage($id_img)
    {
        try {
            $sql_delete_image = "DELETE FROM gallery WHERE id_img = ?";
            $stmt_delete_image = $this->connexion->prepare($sql_delete_image);
            $stmt_delete_image->execute([$id_img]);
            return true;
        } catch (Exception $e) {
            error_log("Échec de la suppression de l'image : " . $e->getMessage(), 0);
            return false;
        }
    }

    /**
     * Méthode pour récupérer tous les messages de la base de données.
     */
    public function getAllMessages() {
        $query = "SELECT * FROM message";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Méthode pour récupérer un utilisateur par son ID.
     */
    public function getUserById($user_id) {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Méthode pour supprimer un message par son ID.
     */
    public function deleteMessage($id_message) {
        $query = "DELETE FROM message WHERE id_message = :id_message";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(':id_message', $id_message);
        $stmt->execute();
    }

    /**
     * Méthode pour récupérer tous les utilisateurs de la base de données.
     */
    public function getAllUsers() {
        $stmt = $this->connexion->prepare('SELECT * FROM users WHERE id_admin IS NULL');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Méthode pour supprimer un utilisateur par son ID.
     */
    public function deleteUser($user_id) {
        $stmt = $this->connexion->prepare('DELETE FROM users WHERE user_id = :user_id');
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    /**
     * Méthode pour mettre à jour le mot de passe d'un admin.
     * @param string $email L'adresse email de l'admin.
     * @param string $new_password Le nouveau mot de passe.
     * @return bool Retourne true si la mise à jour a réussi, sinon false.
     */
    public function updatePassword($email, $new_password)
    {
        try {
            // Vérifier si l'utilisateur est un administrateur
            $sql_check_admin = "SELECT admin_email FROM admin WHERE admin_email = ?";
            $stmt_check_admin = $this->connexion->prepare($sql_check_admin);
            $stmt_check_admin->execute([$email]);
            $admin_email = $stmt_check_admin->fetchColumn();

            if (!$admin_email) {
                // L'utilisateur n'est pas un administrateur, retourner false
                return false;
            }

            // Hachez le nouveau mot de passe
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Mettez à jour le mot de passe haché dans la base de données
            $sql_update_password = "UPDATE admin SET admin_password = ? WHERE admin_email = ?";
            $stmt_update_password = $this->connexion->prepare($sql_update_password);
            return $stmt_update_password->execute([$hashed_password, $email]);
        } catch (PDOException $e) {
            error_log("Échec de la mise à jour du mot de passe : " . $e->getMessage(), 0);
            return false;
        }
    }
}
?>