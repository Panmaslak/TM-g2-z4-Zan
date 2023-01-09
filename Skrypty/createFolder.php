<?php
session_start();
$user = $_SESSION["username"];
if (!empty($_POST['folderName'])) {
    // Pobierz nazwę nowego folderu z formularza
    $folderName = $_POST['folderName'];

    // Pobierz aktualny katalog użytkownika
    $baseDir = "users/$user";
    $currentDir = !empty($_GET['dir']) ? $_GET['dir'] : $baseDir;
    $currentDir = rtrim($currentDir, '/');

    // Utwórz nowy folder o podanej nazwie
    mkdir($currentDir . '/' . $folderName);
}

?>
<form method="post">
    <label>Nazwa folderu: <input type="text" name="folderName"></label>
    <input type="submit" value="Utwórz folder"><br>

     <a href='index1.php'>Powrót</a>
</form>
