<?php
// Page d'accueil

// Chemin absolu vers le répertoire parent du répertoire actuel pour accéder au controller
require_once dirname(__DIR__) . "/controllers/Controller.php";

// Si on est pas connecté en tant qu'administrateur, on affiche ce contenu html
if (!(isset($_SESSION['admin']) && $_SESSION['admin'] === true)) {
?>

<section class="home">
<article>
    <img src="../img/header-home.jpg" alt="" class="carousel">
    <h1>Bienvenue sur mon Site</h1>
    <h2 class="brandFont">Mavryl Arts</h2>
</article>
<article>
    <h2>Mes dernieres oeuvres</h2>
    <div class="last-work">
        <img src="../img/bird-art-home.jpg" alt="">
        <img src="../img/bird-art1.jpg" alt="">
        <img src="../img/artwork-home.jpg" alt="">
    </div>
    <a href="?page=gallery">Voir plus ...</a>
</article>
<article>
    <h2>A propos de moi ...</h2>
    <img src="../img/about-drawing.png" alt="" class="about-drawing">
    <p>
        Je suis une artiste inspirée par la nature et les animaux. 
        À travers mes dessins, peintures et photographies, je célèbre la beauté et la diversité de notre monde sauvage. 
        Bienvenue dans mon univers artistique, où chaque œuvre raconte une histoire.
    </p>
</article>
<article>
    <h2>Créations Sur Mesure : Commissions et Pièces Originales</h2>
    <p>
        Vous êtes intéressé par une œuvre ou vous souhaitez une pièce personnalisée ? 
        Contactez-moi dès maintenant pour donner vie à votre vision artistique !
    </p>
    <a href="?page=contact">Contactez moi</a>
    <figure>
        <img src="../img/cat-art1.jpg" alt="" class="commission">
        <figcaption>Luna et Simba, pour Nora</figcaption>
    </figure>
</article>
</section>

<?php
}

// Si on est connecté en tant qu'administrateur, à la place, on affiche ce contenu html
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Crée une instance de BddConnect
    $bdd = new BddConnect();    
    
    // Vérifie si la requête de suppression est envoyée
    if (isset($_POST['delete_user'])) {
        // Récupère l'ID de l'utilisateur à supprimer
        $user_id = $_POST['id_user'];
        
        // Exécute la suppression de l'utilisateur dans la base de données
        $deleted = $bdd->deleteUser($user_id);
        
        // Vérifie si la suppression a réussi
        if ($deleted) {
            echo "<p>Utilisateur supprimé avec succès.</p>";
        } else {
            echo "<p>Échec de la suppression de l'utilisateur.</p>";
        }
    }
    
    // Récupère la liste des utilisateurs depuis la base de données
    $users = $bdd->getAllUsers();
?>

<section class="admin-users">
    <h2>Liste des utilisateurs</h2>
    <?php
    // Affiche chaque utilisateur avec un bouton de suppression
    foreach ($users as $user) {
        echo "<article>";
        echo "<p>Nom: " . htmlspecialchars($user['user_last_name']) . "</p>";
        echo "<p>Prénom: " . htmlspecialchars($user['user_first_name']) . "</p>";
        echo "<p>Email: " . htmlspecialchars($user['user_email']) . "</p>";
        // Formulaire de suppression de l'utilisateur
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='id_user' value='" . htmlspecialchars($user['user_id']) . "'>";
        echo "<button type='submit' name='delete_user' class='delete'>Supprimer</button>";
        echo "</form>";
        echo "</article>";
    }
    ?>
</section>

<?php
}
?>