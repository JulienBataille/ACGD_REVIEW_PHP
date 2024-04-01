<?php
include 'Config/database.php';
$categories = ["evenements"];

$articles = array();

foreach($categories as $category) {
    $sql = "SELECT article.title, article.cover, article.description  
            FROM article
            INNER JOIN categories  
                ON article.categories_id = categories.id 
            WHERE categories.title = :category
            ORDER BY article.id DESC
            LIMIT 3";

    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':category' => $category));
    $articles[$category] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include ('_partials/head.php') ?>
<body>
<?php include ('_partials/header.php') ?>
<?php
// Цикл для первой карусели с автоматической прокруткой
foreach ($categories as $categoryIndex => $category) :
    ?>
    <div id="carousel1<?= ucfirst($category) . $categoryIndex ?>" class="carousel slide" data-bs-ride="carousel" >
        <div class="carousel-inner" >
            <?php
            $active = true;
            foreach ($articles[$category] as $article) :
                ?>
                <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                    <img src="./assets/image/covers/<?= $article['cover'] ?>" class="d-block w-100" alt="<?= $article['title'] ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?= $article['title'] ?></h5>
                        <p><?= $article['description'] ?></p>
                    </div>
                </div>
                <?php
                $active = false;
            endforeach;
            ?>
        </div>
    </div>
<?php endforeach; ?>

<!-- Заголовок h2-h3 -->
<div class="row text-center mt-3">
    <div class="col-md-12">
        <h2 class="fw-bolder text-uppercase" style="color: #FF4500;">ÉVÉNEMENTS</h2>
    </div>
</div>

<!-- Блок с заголовком "actualités" -->
<div class="text-center mt-2 row h-80">
    <div class="col-12 align-self-center">
        <h3 class="fw-normal text-uppercase bg-dark text-white text-sm" style="height: 50px; line-height: 50px;">actualités</h3>
    </div>
</div>

<!-- Цикл для второй карусели с кнопками управления -->
<?php foreach ($categories as $categoryIndex => $category) : ?>
    <div id="carousel2<?= ucfirst($category) . $categoryIndex ?>" class="carousel slide" >
        <div class="carousel-inner">
            <?php
            $active = true;
            foreach ($articles[$category] as $index => $article) :
                ?>
                <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                    <div class="container">
                        <div class="row">
                            <?php foreach ($articles[$category] as $index => $article) : ?>
                                <div class="col-md-4">
                                    <div class="card h-100">
                                        <img src="./assets/image/covers/<?= $article['cover'] ?>" class="card-img-top" alt="<?= $article['title'] ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $article['title'] ?></h5>
                                            <p class="card-text"><?= $article['description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php
                $active = false;
            endforeach;
            ?>
        </div>
        <!-- Кнопки управления для второй карусели -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?= ucfirst($category) . $categoryIndex ?>" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel<?= ucfirst($category) . $categoryIndex ?>" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php endforeach; ?>




<div class="text-center mt-2 row h-80">
    <div class="col-12 align-self-center">
        <h3 class="fw-normal text-uppercase bg-dark text-white text-sm" style="height: 50px; line-height: 50px;">spectacles</h3>
    </div>
</div>
    </div>
    <!--actu-->
    <div class=" row ms-4" widht="100%">
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/concert01.jpg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/concert02.jpg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/presentationbook01.jpeg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Dates</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/spectacle01.jpeg" class="card-img-top" alt="..." height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div> 
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/concert01.jpg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>                   
    </div> 
    <div class="text-center mt-2 row h-80">
    <div class="col-12 align-self-center">
        <h3 class="fw-normal text-uppercase bg-dark text-white text-sm" style="height: 50px; line-height: 50px;">dédicases</h3>
    </div>
</div>
    <!--actu-->
    <div class=" row ms-4" widht="100%">
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/concert01.jpg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/concert02.jpg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/presentationbook01.jpeg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Dates</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/spectacle01.jpeg" class="card-img-top" alt="..." height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div> 
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/concert01.jpg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>                   
    </div> 
    <div class="text-center mt-2 row h-80">
    <div class="col-12 align-self-center">
        <h3 class="fw-normal text-uppercase bg-dark text-white text-sm" style="height: 50px; line-height: 50px;">concerts/festivales</h3>
    </div>
</div>
    <!--actu-->
    <div class=" row ms-4" widht="100%">
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/concert01.jpg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/concert02.jpg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/presentationbook01.jpeg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Dates</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/spectacle01.jpeg" class="card-img-top" alt="..." height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div> 
      <div class="card col-12 ms-2 col-md-3 mb-2 mx-auto" style="width: 18rem;">
        <img src="./assets/image/events/concert01.jpg" class="card-img-top" alt="..."  height="144">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="dropdown mx-auto p-2 mb-5">
          <button class="btn btn-secondary dropdown-toggle" id="bouton_orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            +d'info
          </button>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Date</button></li>
            <li><button class="dropdown-item" type="button">Lieu</button></li>
            <li><button class="dropdown-item" type="button">Information supplementaire</button></li>
          </ul>
        </div>
      </div>                   
    </div>  
    <div class="limit text-center py-4">
      <a href="#" class=""><img src="./assets/image/series/UP.svg" alt="Go up" class=""></a>
  </div>
<?php include ('_partials/footer.php') ?>
</body>
</html>