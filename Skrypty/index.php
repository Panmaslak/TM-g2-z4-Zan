<?php declare (strict_types=1);
	session_start();

	if(isset($_SESSION["lockTime"]))
    {
		$difference = time() - $_SESSION["lockTime"];
		if($difference > 60)
        {
			unset($_SESSION["lockTime"]);
			unset($_SESSION["accountBlocked"]);
		}
	}
	
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Zań</title>
</head>
<body>
    <p><b>Zadanie 4. MyCloud</b></p>

    <form method="post" action="weryfikuj1.php">
    Login:<input type="text" name="userl" id="userl" maxlength="20" size="20"><br>
    Hasło:<input type="password" name="passl" id="userl" maxlength="20" size="20"><br>
    <?php
    if (isset($_SESSION['accountBlocked']))
    {
        $timeDiff = 60 - $difference;
        echo "Zbyt duża ilość błędnych prób logowania. Proszę poczekaj " . $timeDiff . " sekund przed kolejną próbą <br>";
    }
    else
    {
        ?>
    
    <input type="submit" value="Zaloguj się"/> <br />
    <?php
    }
    ?>

      Nie masz konta? <a href="index3.php"> Zarejestruj się </a>


</body>


</html>