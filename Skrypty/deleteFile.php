<?php
if (!empty($_GET['file'])) {
    // Pobierz ścieżkę do pliku z parametru GET
    $filePath = $_GET['file'];

    // Usuń plik
    unlink($filePath);
}

// Przekieruj użytkownika do strony z katalogiem
header('Location: index1.php?dir=' . dirname($filePath));
