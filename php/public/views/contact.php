<?php

// Chemin absolu vers le répertoire parent du répertoire actuel pour accéder au controller
require_once dirname(__DIR__) . "/controllers/Controller.php";

// Créez une instance du contrôleur
$controller = new Controller;

// Tableau de mappage des catégories de message
$messageCategories = [
    1 => "Commission personnalisée",
    2 => "Demande de devis",
    3 => "Achat d'une oeuvre"
];

// Si on est pas connecté en tant qu'admin, on affiche l'html suivant
if (!(isset($_SESSION['admin']) && $_SESSION['admin'] === true)) {
?>
<article>
    <h2 class="pageBlank">Contactez-moi</h2>
</article>

<article class="form">
    <form method="post">
        <!-- Formulaire de contact -->
        <input type="text" name="user_last_name" placeholder="Nom" required>
        <input type="text" name="user_first_name" placeholder="Prénom" required>
        <input type="email" name="user_email" placeholder="Adresse mail" required>
        <select name="message_category" required>
            <option value="" disabled selected>Votre demande concerne ...</option>
            <option value="1">Commission personnalisée</option>
            <option value="2">Demande de devis</option>
            <option value="3">Achat d'une oeuvre</option>
        </select>
        <textarea name="message_content" cols="30" rows="10" placeholder="Écrivez ici votre message ..." required></textarea>
        <label>Je certifie que ces informations sont correctes</label>
        <input type="checkbox" name="accept" required>
        <button type="submit" name="submitForm">Envoyer</button>
    </form>

    <!-- Image du formulaire -->
    <img src="../img/contact.jpg" class="img-form">
</article>

<?php
}

// Traitement du formulaire de contact lors de sa soumission
if (isset($_POST['submitForm'])) {
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $message_category = $_POST['message_category'];
    $message_content = $_POST['message_content'];

    // Insertion des données de contact dans la base de données en utilisant l'instance du contrôleur
    $inserted = $controller->insertMessage($user_last_name, $user_first_name, $user_email, $message_category, $message_content);

    if ($inserted) {
        echo "Votre message a bien été envoyé";
    } else {
        echo "Une erreur s'est produite dans l'envoi de votre message.";
    }
}

// Si on est connecté en tant qu'administrateur, on affiche à la place l'html suivant
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Créez une instance du contrôleur
    $controller = new Controller;
    
    // Récupération des messages de la base de données
    $messages = $bdd->getAllMessages();

    // On boucle pour afficher chaque message de la bdd en fonction de l'utilisateur qui a publié ce message
    foreach ($messages as $message) {
        $user = $bdd->getUserById($message['user_id']);
        $categoryText = isset($messageCategories[$message['message_category']]) ? $messageCategories[$message['message_category']] : "Unknown category";
        echo "<article>";
        echo "<h2>" . htmlspecialchars($categoryText) . "</h2>";
        echo "<p>" . htmlspecialchars($message['message_content']) . "</p>";
        echo "<p>Publié par : " . htmlspecialchars($user['user_first_name']) . " " . htmlspecialchars($user['user_last_name']) . "</p>";
        echo "<p>Email : " . htmlspecialchars($user['user_email']) . "</p>";
        echo "<form method='post'>
                <input type='hidden' name='id_message' value='" . htmlspecialchars($message['id_message']) . "'>
                <button type='submit' name='delete_message' class='delete'>Supprimer</button>
              </form>";
        echo "</article>";
    }
}

// Traitement de la suppression des messages
if (isset($_POST['delete_message'])) {
    $id_message = $_POST['id_message'];
    
    // Suppression du message de la base de données
    $bdd->deleteMessage($id_message);
}
?>
