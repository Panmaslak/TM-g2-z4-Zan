<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Zań</title>
</head>

<body>
    <?php
    $user = $_POST['user']; // login z formularza
    $user = htmlentities ($user, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
    $pass = $_POST['pass']; // hasło z formularza
    $pass = htmlentities ($pass, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $pass
    $confirmedPass = $_POST['confirm-pass']; // potwierdzenie hasła z formularza
    $confirmedPass = htmlentities ($confirmedPass, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $confirmedPass
   
    $link = mysqli_connect("sql112.epizy.com", "epiz_32762504", "Px9R2V2FcqoEV" ,"epiz_32762504_myCloud"); // połączenie z BD – wpisać swoje dane
    if(!$link) 
    { 
        echo "Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); 
    } // obsługa błędu połączenia z BD

    mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
    $result = mysqli_query($link, "SELECT * FROM users WHERE username='$user'"); // wiersza, w którym login=login z formularza
    $rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD

    if(!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
    { 
        if (preg_match("#^[a-zA-Z0-9]+$#", $user)) 
        {
             if ($confirmedPass == $pass) 
                {   
                    $querry = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
                        if ($link->query($querry)) 
                        {
                            echo "Rejestracja zakończona pomyślnie!";
                        
                        } 
                        else 
                        {
                            echo "Błąd: " . $querry . "<br>" . $link->error;
                        }
                    }
                    else
                        echo "Hasła muszą być takie same";

        } 
        else 
        {
            echo 'Nazwa uzytkownika może zawierać tylko litery i cyfry';
        }
               
    }
    else
    { // jeśli $rekord istnieje
        echo "Użytkownik o podanym loginie już istnieje!";

    }


    mkdir("users/$user");
    ?>

    <a href="index3.php">Powrót</a>

</body>

</html>