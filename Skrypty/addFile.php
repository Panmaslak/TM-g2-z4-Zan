<?php

if (!empty($_FILES['uploadedFile']) && !empty($_GET['dir'])) {
    // Pobierz ścieżkę do aktualnego katalogu użytkownika z parametru GET
    $currentDir = $_GET['dir'];

    // Pobierz plik z formularza
    $uploadedFile = $_FILES['uploadedFile'];

    // Przenieś plik do aktualnego katalogu użytkownika
    move_uploaded_file($uploadedFile['tmp_name'], $currentDir . '/' . $uploadedFile['name']);
}

?>
<form method="post" enctype="multipart/form-data">
    <label> Plik: <input type="file" name="uploadedFile"></label>
    <input type="submit" value="Prześlij plik">
</form>

<br>

<!-- Dodaj link umożliwiający powrót do aktualnego katalogu -->
<a href='index1.php?dir=<?php echo $currentDir; ?>'>Powrót</a>
