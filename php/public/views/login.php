<?php
if (!isset($_SESSION)) {
    session_start();
}
ob_start();
require_once dirname(__DIR__) . "/controllers/Controller.php";

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Connexion
        $email = $_POST['email'];
        $password = $_POST['password'];
        $bdd = new BddConnect();
        $sql = "SELECT id_admin, admin_password FROM admin WHERE admin_email = ?";
        $stmt = $bdd->connexion->prepare($sql);
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['admin_password'])) {
            // Mot de passe correct, connectez l'administrateur
            $_SESSION['admin'] = true;
            $_SESSION['admin_id'] = $admin['id_admin'];
            header("Location: ?page=admin");
            exit();
        } else {
            $error_message = "Échec de la connexion. Vérifiez votre adresse e-mail et votre mot de passe.";
        }
    } elseif (isset($_POST['change_password'])) {
        // Changement de mot de passe
        $email = $_POST['email'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_password'];

        // Vérification du mot de passe actuel et de l'e-mail
        $bdd = new BddConnect();
        $sql_check_credentials = "SELECT admin_password FROM admin WHERE admin_email = ?";
        $stmt_check_credentials = $bdd->connexion->prepare($sql_check_credentials);
        $stmt_check_credentials->execute([$email]);
        $admin_data = $stmt_check_credentials->fetch(PDO::FETCH_ASSOC);

        if (!$admin_data) {
            $error_message = "Votre adresse email n'est pas celle de l'administrateur de ce site.";
        } elseif (!password_verify($current_password, $admin_data['admin_password'])) {
            $error_message = "Le mot de passe actuel est incorrect.";
        } elseif ($new_password !== $confirm_new_password) {
            $error_message = "Les nouveaux mots de passe ne correspondent pas.";
        } else {
            // Mot de passe correct, procédez à la mise à jour
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $sql = "UPDATE admin SET admin_password = ? WHERE admin_email = ?";
            $stmt = $bdd->connexion->prepare($sql);
            if ($stmt->execute([$hashed_password, $email])) {
                $error_message = "Mot de passe mis à jour avec succès.";
            } else {
                $error_message = "Échec de la mise à jour du mot de passe.";
            }
        }
    }
}
?>


    <h2 class="pageBlank">Connexion Administrateur</h2>
    <article>
    <form method="POST"class="connectForm">
            <input type="email" id="email" name="email" placeholder="Adresse e-mail :" required><br>
            <input type="password" id="password" name="password" placeholder="Mot de passe :" required><br>
            <input type="submit" name="login" value="Se connecter" class="connect">
        </form>
        <button onclick="showNewPassword()">Modifier le mot de passe</button>
        <form method="post" class="new-password">
            <input type="email" id="email" name="email" placeholder="Adresse e-mail :" required><br>
            <input type="password" id="current_password" name="current_password" placeholder="Votre mot de passe actuel :" required><br>
            <input type="password" id="new_password" name="new_password" placeholder="Nouveau mot de passe :" required><br>
            <input type="password" id="confirm_new_password" name="confirm_new_password" placeholder="Répéter le nouveau mot de passe :" required><br>
            <input type="submit" name="change_password" value="Modifier le mot de passe">
        </form>
        <?php if ($error_message): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </article>
