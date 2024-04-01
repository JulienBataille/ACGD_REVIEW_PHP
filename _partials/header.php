<?php 

include 'Config/database.php'; 
$sqlheader = "SELECT * FROM categories";
$header = $conn->prepare($sqlheader);
$header->execute();




?>

<header class="sticky-top grey">
    <nav class="navbar navbar-expand-xl">
      <div class="container-fluid align-items-center">
        <a class="navbar-brand" href="index.php">
          <img src="./assets/image/areview-header.png" alt="LOGO" width="200" height="100%">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form class="d-flex column-gap-2 align-items-center ms-auto order-lg-2" role="search">
            <input class="form-control thin" type="search" placeholder="Search" aria-label="Search">
            <a href="index.php"><i class="fa-solid fa-magnifying-glass" width= 20px height=100%></i></a>
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
              aria-controls="offcanvasWithBothOptions"> 
              <i class="fa-solid fa-user" width= 20px height=100%></i>
            </button>
          </form>
          <ul class="navbar-nav d-flex flex-fill text-center order-lg-1">
            <?php while($row = $header->fetch()){ ?>
            <li class="nav-item flex-fill">
              <a class="nav-link" href="<?= $row['slug'] ?>.php"><?= $row['title'] ?></a>
            </li>
              <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
    <div class="offcanvas offcanvas-end " data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
    <?php if (isset($_SESSION['email'])) { ?>
        <a href="account.php" class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Acces à mon compte</a>
    <?php } else { ?>
        <span class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Bienvenue sur ACGD REVIEW</span>
    <?php } ?>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>

    <div class="offcanvas-body text-center">
        <div class="d-flex justify-content-center">
            <?php if (!isset($_SESSION['email'])) { ?>
                <div class="col-6 mb-2">
                    <a href="login.php" class="btn" id="bouton_orange">Se connecter</a>
                </div>
                <div class="col-6 mb-2">
                    <a href="register.php" class="btn" id="bouton_orange">S'inscrire</a>
                </div>
            <?php } else { ?>
                <div class="col-6 mb-2">
                    <a href="logout.php" class="btn" id="bouton_orange">Se déconnecter</a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


  </header>