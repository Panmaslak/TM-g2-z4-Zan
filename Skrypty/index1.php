
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<title>Zań</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>

<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset="UTF-8">
<title>Zań</title>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
</style>
<table class="tg">

<?php


    // echo "<form method='post' action='add.php' enctype='multipart/form-data' ><br>";
    // echo "<label for='plik'>Wybierz plik:</label><br>";
    // echo "<input type='file' id='fileToUpload' name='fileToUploadName' accept='image/*,video/*,audio/*'>";
    // echo "<div id='wyswietlacz'></div>";


?>



<?php
    session_start();
    $user = $_SESSION["username"];
    $dbhost="sql112.epizy.com"; $dbuser="epiz_32762504"; $dbpassword="Px9R2V2FcqoEV"; $dbname="epiz_32762504_myCloud";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    if (!$connection)
    {
    echo " MySQL Connection error." . PHP_EOL;
    echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error: " . mysqli_connect_error() . PHP_EOL;
    exit;
    }

    $resulttt = mysqli_query($connection, "Select ipaddress, time from  break_ins where username = '$user' order by time desc;") or die ("DB error: $dbname");


    $roww = mysqli_fetch_array($resulttt);


      
    if (isset($_SESSION['communique']))
    {
        echo  '<span style="color:red">' . $roww['time'] . " Nastąpiła próba logowania na twoje konto z adresu IP " .  $roww['ipaddress'] . '</span> <br>';
        unset($_SESSION["communique"]);
    }

 
?>



<?php
    // echo "<input type='submit' value='Upload' name='submit'>";
    // echo" </form> <br>";
    session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
    if (!isset($_SESSION['loggedin']))
    {

    header('Location: index.php');
    exit(); 
    }
   
    $user = $_SESSION["username"];
    $dbhost="sql112.epizy.com"; $dbuser="epiz_32762504"; $dbpassword="Px9R2V2FcqoEV"; $dbname="epiz_32762504_myCloud";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    if (!$connection)
    {
    echo " MySQL Connection error." . PHP_EOL;
    echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error: " . mysqli_connect_error() . PHP_EOL;
    exit;
    }






    // $result = mysqli_query($connection, "Select * from  files where user = '$user' Order by id Desc;") or die ("DB error: $dbname");
    // print "<form action='createFolder.php' method='post'>";
    // print "<input type='text' id='pname' name='pname' placeholder='Podaj nazwę folderu'>";
    // print "<input type='submit' class='button' value='Utwórz nowy folder' style='background-image: url('createFolderIcon.png');'>";
    // print "</form> <br>";

    // print "<form action='deleteFolder.php' method='post'>";
    // print "<input type='text' id='df' name='df' placeholder='Podaj nazwę folderu'>";
    // print "<input type='submit' class='button' value='Usuń folder'>";
    // print "</form> <br>";

  


    $filesInFolder = array();
    $baseDir = "users/$user";
    $currentDir = !empty($_GET['dir']) ? $_GET['dir'] : $baseDir;
    $currentDir = rtrim($currentDir, '/');

    $iterator = new FilesystemIterator($currentDir);
    
    echo "<br><br><b style='font-size: 22px;'> Katalog: " . $iterator->getPath();
    if ($currentDir == $baseDir)
    {
        echo "&nbsp; <a href='createFolder.php'><img height='22px' width='22px' src='createFolderIcon.png'></a>";
    }
    echo "&nbsp; <a href='addFile.php?dir=$currentDir'><img height='25px' width='25px' src='uploadFileIcon.png'></a>";
    echo "</b><br>";

    echo "&nbsp;&nbsp;&nbsp;&nbsp;<b>Katalogi:</b><br>";
    foreach ($iterator as $entry)
    {
        $name = $entry->getBasename();

    if (is_dir($currentDir . '/' . $name)) {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?dir=" . $currentDir . "/" . $name . "'>" . $name
            . "&nbsp;&nbsp;<a href='deleteFolder.php?dir=$currentDir/$name'><img height='15px' width='15px' src='deleteFolderIcon.png'></a></a><br>";
    }
    
}
    if ($currentDir != $baseDir)
    {
    echo "<br><a href='?dir=$baseDir'><img height='30px' width='30px' src='previousFolderIcon.png'></a><br>";
    }
  print "<a href ='logout.php'>Wyloguj się</a><br/>";


echo "<table>";
foreach ($iterator as $entry)
{
    $name = $entry->getBasename();
    $filePath = $currentDir . '/' . $name;

    if (is_file($filePath)) {
        echo "<tr>";


        echo "<td>";
        if (in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['gif', 'jpg', 'jpeg', 'png', 'webp'])) {
            echo "<img src='$filePath' style='max-height: 200px; max-width: 200px;'>";
        } else if (in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['mp3', 'mp4'])) {
            echo "<video src='$filePath' style='max-height: 200px; max-width: 200px;' controls></video>";
        } else {
            echo "<i>Brak podglądu</i>";
        }
        echo "</td>";


        echo "<td>$name</td>";

        echo "<td><a href='download.php?file=$filePath'>Pobierz plik</a></td>";

         echo "<td><a href='deleteFile.php?file=$filePath'><img src='deleteFolderIcon.png'  width='15' height='15' ></a></td>";

        echo "</tr>";
       


    }
}
echo "</table>";





 



    // while ($row = mysqli_fetch_array ($result))
    // {
    // $id = $row[0];
    // $file = $row[1];
    // $type = $row[2];
    // $filename = $row[3];
    // $user = $row[4];
    // if($filename == "jpg" || $filename == "png" || $filename == "gif" || $filename == "jpeg" || $filename == "webp")
    // {
    //     $file = "<img width='100' height='100' src='$file'>";
    // }  
    // else if ($filename == "mp3")
    // {
    //     $file = "<audio controls autoplay = 'false'><source src='$file'></audio>";
                  
    // }
    // else if ($filename == "mp4")
    // {
    //      $file = "<video controls autoplay = 'true' muted = 'true' ><source src='$file'></audio>";
    // }


    // $username = $_SESSION ['username'];
    // $target_dir = "users/".$username;
    // $target_file = $target_dir . "/". basename($_FILES["fileToUploadName"]["name"]);

    
       
    // print "<TR><TD style='display: none;' >$id</TD><TD>$file</TD><TD>$type</TD><TDstyle='display: none;'>$filename</TD><TD style='display: none;' >$user</TD>
    // <TD><a href='download.php?download=$target_file$type'>Pobierz plik</a></TD></TR>\n";
    // }


    // print "</TABLE>";






    ?>

</BODY>
</HTML>
