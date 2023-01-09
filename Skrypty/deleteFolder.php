<?php

// Pobierz nazwę folderu do usunięcia z adresu URL
$folderToDelete = !empty($_GET['dir']) ? $_GET['dir'] : '';

// Jeśli nazwa folderu jest pusta, to przerwij skrypt
if (empty($folderToDelete)) {
    exit;
}

// Sprawdź, czy folder jest pusty
if (is_dir_empty($folderToDelete)) {
    // Usuń folder o podanej nazwie
    rmdir($folderToDelete);
    header('Location: index1.php');
} else {
    // W przeciwnym razie wyświetl komunikat o błędzie
    echo "Aby usunąć folder, należy najpierw usunąć wszystkie pliki, które się w nim znajdują.";
}

// Funkcja sprawdzająca, czy folder jest pusty
function is_dir_empty($dir) {
    $handle = opendir($dir);
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            closedir($handle);
            return false;
        }
    }
    closedir($handle);
    return true;
}
