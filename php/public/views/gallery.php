<?php
require_once dirname(__DIR__) . "/controllers/Controller.php";

// Créez une instance du contrôleur
$controller = new Controller;

// Récupérez toutes les images de la base de données
$images = $controller->getAllImages();

?>

<article class="gallery">
    <h2 class="pageBlank">Galerie</h2>
    <?php
    if (!empty($images)) {
        foreach ($images as $image) {
            echo "<figure>";
            echo "<img src='../img/" . htmlspecialchars($image['path_img']) . "' alt='" . htmlspecialchars($image['title_img']) . "'>";
            echo "<figcaption>" . htmlspecialchars($image['title_img']) . "</figcaption>";
            if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
                echo "<form method='POST' action=''>
                        <input type='hidden' name='id_img' value='" . htmlspecialchars($image['id_img']) . "'>
                        <button type='submit' name='delete_image' class='delete'>Supprimer</button>
                      </form>";
            }
            echo "</figure>";
        }
    } else {
        echo "<p>No images found.</p>";
    }
    ?>
</article>

<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
?>
    <form method="POST" action="" enctype="multipart/form-data" class="form">
        <input type="file" name="image" accept="image/*" required>
        <input type="text" name="title_img" placeholder="Titre de l'image" required>
        <button type="submit" name="add_image">Ajouter</button>
    </form>
<?php
}

// Traitement du formulaire d'ajout d'image
if (isset($_POST['add_image'])) {
    $targetDir = __DIR__ . "/../img/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Vérifiez si le fichier image est une image réelle ou une fausse image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }

    // Vérifiez si le fichier existe déjà
    if (file_exists($targetFile)) {
        echo "Désolé, le fichier existe déjà.";
        $uploadOk = 0;
    }

    // Vérifiez la taille du fichier
    if ($_FILES["image"]["size"] > 500000) {
        echo "Désolé, votre fichier est trop volumineux.";
        $uploadOk = 0;
    }

    // Autoriser certains formats de fichier
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        $uploadOk = 0;
    }

    // Vérifiez si $uploadOk est défini à 0 par une erreur
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléchargé.";
    // si tout est ok, essayez de télécharger le fichier
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Ajoutez l'image à la base de données
            $path_img = basename($_FILES["image"]["name"]);
            $title_img = htmlspecialchars($_POST['title_img']);
            $controller->addImage($path_img, $title_img);
            echo "Le fichier ". htmlspecialchars(basename($_FILES["image"]["name"])). " a été téléchargé.";
        } else {
            echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }
}

// Traitement du formulaire de suppression d'image
if (isset($_POST['delete_image'])) {
    $id_img = htmlspecialchars($_POST['id_img']);
    $controller->deleteImage($id_img);
    echo "L'image a été supprimée.";
}
?>
