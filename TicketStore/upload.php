<?php

$target_dir = "View/imgs/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Controlla se il file immagine è un'immagine reale o un'immagine falsa
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo '<script type="text/javascript">
                            alert("Il File non è un immagine")
                            window.location= "/TicketStore/Amministratoreimg"
                          </script>';
        $uploadOk = 0;
    }
}

// Controlla se il file esiste già
if (file_exists($target_file)) {
    echo '<script type="text/javascript">
                            alert("Spiacente. Il File già esiste")
                            window.location= "/TicketStore/Amministratoreimg"
                          </script>';
    $uploadOk = 0;
}
// controlla la grandezza del file
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo '<script type="text/javascript">
                            alert("Spiacente. Il File è troppo grande")
                            window.location= "/TicketStore/Amministratoreimg"
                          </script>';
    $uploadOk = 0;
}
// Consenti determinati formati di file
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo '<script type="text/javascript">
                            alert("Spiacente, sono permessi solo i file  JPG, JPEG, PNG & GIF.")
                            window.location= "/TicketStore/Amministratoreimg"
                          </script>';
    $uploadOk = 0;
}
// Controlla se $ uploadOk è impostato su 0 da un errore
if ($uploadOk == 0) {
    echo '<script type="text/javascript">
                            alert("Spiacente, Il tuo File non è stato caricato.")
                            window.location= "/TicketStore/Amministratoreimg"
                          </script>';
// se tutto è a posto, prova a caricare il file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo '<script type="text/javascript">
                            alert("Il tuo File è stato caricato.")
                            window.location= "/TicketStore/validazione"
                          </script>';
    } else {
       echo '<script type="text/javascript">
                            alert("Spiacente, c\'è stato un errore nel caricamento del file")
                            window.location= "/TicketStore/Amministratoreimg"
                          </script>';
    }
    
}


