<?php
if (!empty($_GET['file'])) {
    // Pobierz ścieżkę do pliku z parametru GET
    $filePath = $_GET['file'];

    // Jeśli plik istnieje, wyślij go do przeglądarki użytkownika
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }
}

?>
