<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if(isset($_SESSION['email'])) {
    // Rediriger l'utilisateur vers une autre page, par exemple, sa page de profil
    header('Location: account.php');
    exit();
}

include 'Config/database.php';

global $message;

// Vérifier si le formulaire est soumis
if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['birth_date']) && isset($_POST['gender'])){
    // récupérer les données du formulaire dans des variables
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];

    // Vérifier si l'email existe déjà dans la base de données
    $sqlCheckEmail = "SELECT email FROM user WHERE email = :email";
    $stmtCheckEmail = $conn->prepare($sqlCheckEmail);
    $stmtCheckEmail->execute(['email' => $email]);
    $userWithEmail = $stmtCheckEmail->fetch();

    // Vérifier si le pseudo existe déjà dans la base de données
    $sqlCheckPseudo = "SELECT pseudo FROM user WHERE pseudo = :pseudo";
    $stmtCheckPseudo = $conn->prepare($sqlCheckPseudo);
    $stmtCheckPseudo->execute(['pseudo' => $pseudo]);
    $userWithPseudo = $stmtCheckPseudo->fetch();

    if($userWithEmail){
        $message = "Cet email existe déjà";
    } elseif ($userWithPseudo) {
        $message = "Ce pseudo est déjà utilisé";
    } else {
        // Insérer les données dans la base de données
        $sqlRegister = "INSERT INTO user (`pseudo`,`email`,`password`,`birth_date`,`is_valide`,`created_at`,`gender`,`role`, `picture`, `banner`,`latest_connection`)
                VALUES (:pseudo, :email, :password, :birth_date, :is_valide, :created_at , :gender, :role, :picture, :banner, :latest_connection)";
        $stmtRegister = $conn->prepare($sqlRegister);
        $stmtRegister->execute([
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'birth_date' => $birth_date,
            'is_valide' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'gender' => $gender,
            'role' => '["ROLE_USER"]',
            'picture' => 'default_avatar.jpg',
            'banner' => 'default_banner.jpg',
            'latest_connection' => date('Y-m-d H:i:s')
        ]);

        $_SESSION['email'] = $email;

        header('Location: account.php');
        exit();
    }

}
?>





<!DOCTYPE html>
<html lang="en">


<?php include '_partials/head.php'; ?>

<body>

<?php include '_partials/header.php'; ?>

<main>
    <h1 >Register</h1>
    <h2 class="text-danger"><?= $message ?></h2>

    </form>
    <div id="formulaire" class="my-5">
      <form class="row col-xl-6 mx-auto" method="POST" action="register.php">
      <div class="col-12 col-xl-12 mb-4">
          <label class="form-label" for="pseudo">Votre pseudo</label>
          <input type="text" name="pseudo" class="form-control"value="" required>
        </div>
        <div class="col-12 col-xl-6 mb-4" >
          <label class="form-label" for="birth_date">Date de naissance</label>
          <input type="date" name="birth_date" class="form-control" value="" required>
        </div>
        <div class="col-12 col-xl-6 mb-4" >
            <label class="form-label" for="gender">Genre</label>
            <select name="gender" class="form-select" id="inputGroupSelect01">
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
                <option value="Autre">Autre</option>
            </select>
        </div>
        <div class="col-12 col-xl-12 mb-4">
          <label class="form-label" for="email">Votre adresse mail</label>
          <input type="email" name="email" class="form-control" value="" required>
        </div>
        <div class="col-12 col-xl-12 mb-4">
          <label class="form-label" for="password">Mot de passe</label>
          <input type="password" name="password" class="form-control" value="" required>
        </div>
        <div class="col-12 mt-5 mb-2">
            <input type="hidden" id="recaptchaResponse" name="recaptcha-response">
        </div>
        <div class="col-12 my-5 text-center">
          <button class="btn btn-primary" type="submit" id="bouton_orange">S'inscrire</button>
        </div>

      </form>
    </div>
</main>

<?php include '_partials/footer.php'; ?>


</body>
</html>