<?php 
session_start();
if(!isset($_SESSION['email'])){
	header('Location: login.php');
}
    include '../Config/database.php';
    global $message ;
    // Création du CRUD

    // méthode pour supprimer un utilisateur
    if(isset($_GET['method']) && $_GET['method'] == 'delete'){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM user WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $message = "<div class='alert alert-success text center'>L'utilisateur a été supprimé </div>";
        }
    }

    // Methode pour modifier un utilisateur

    

    //méthode pour lister les utilisateurs
    $sql = "SELECT * FROM user";
    $stmt = $conn->prepare($sql);
    $stmt->execute();


?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div>
    	<a href="../index.php" name="acceuil">ACCEUIL</a>
    	<a href="../account.php" name="account">ACCOUNT</a>
        <a href="../cinema.php" name="cinema">CINEMA</a>
        <a href="../series.php" name="series">SERIES</a>
        <a href="../gaming.php" name="gaming">GAMING</a>
        <a href="../evenements.php" name="evenement">EVENEMENT</a>
        <a class="deco" href="../logout.php" name="logout">DECONNEXION</a>
    </div>		
<style type="text/css">
.tftable {font-size:12px;color:#fbfbfb;width:100%;border-width: 1px;border-color: #686767;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#171515;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;text-align:left;}
.tftable tr {background-color:#2f2f2f;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;}
.tftable tr:hover {background-color:#171515;}
<<<<<<< HEAD
.deco{color: red; font-weight: bold;}
=======
>>>>>>> 0326ed6126a373bd40025603cd579265e92f2b8e
</style>
<?= $message ?>
<table class="tftable" border="1">
<tr><th>Id</th><th>Pseudo</th><th>Email</th><th>Né(e) le </th><th>Membre depuis le </th><th>Détails</th><th>Modifier</th><th>Supprimer</th></tr>

<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
<tr><td><?= $row['id'] ?></td><td><?= $row['pseudo'] ?></td><td><?= $row['email'] ?></td><td><?= $row['birth_date'] ?></td><td><?= $row['created_at'] ?></td>
    <td><a href="">Voir plus</a> </td>
    <td><a href="index_user.php?method=update&id=<?=$row['id'] ?>">Modifier</a></td>
    <td><a href="index.php?method=delete&id=<?=$row['id'] ?>">Supprimer</a> </td>
</tr>
<?php } ?>
</table>

</body>
</html>