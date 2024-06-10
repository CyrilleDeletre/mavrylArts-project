<!-- Composant header de chaque page -->
<header>
    <div id="btn-burger">☰</div>
    <nav class="main-nav-burger">
        <ul>            
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                <a href="?page=admin" alt="logo de Mavryl Arts"><img class="nav-logo" src="../img/logo-mavrylArts.png"></a>
            <?php else: ?>
                <a href="../" alt="logo de Mavryl Arts"><img class="nav-logo" src="../img/logo-mavrylArts.png"></a>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                <li><a href="../">Utilisateurs</a></li>
            <?php else: ?>
                <li><a href="../">Accueil</a></li>
            <?php endif; ?>
            
            <li><a href="?page=gallery">Galerie</a></li>
            
            <?php if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true): ?>
                <li><a href="?page=about">A propos</a></li>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                <li><a href="?page=contact">Messagerie</a></li>
                <li><a href="?page=logout">Deconnexion</a></li>
            <?php else: ?>
                <li><a href="?page=contact">Contact</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
