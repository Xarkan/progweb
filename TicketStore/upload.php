<?php

$target_dir = "View/imgs/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Controlla se il file immagine è un'immagine reale o un'immagine falsa
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "il File è image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Il File non è un'immagine.";
        $uploadOk = 0;
    }
}

// Controlla se il file esiste già
if (file_exists($target_file)) {
    echo "Spiacente, il file già esiste.";
    $uploadOk = 0;
}
// controlla la grandezza del file
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Spiacente, il tuo file è troppo grande.";
    $uploadOk = 0;
}
// Consenti determinati formati di file
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Spiacente, sono permessi solo i file  JPG, JPEG, PNG & GIF.";
    $uploadOk = 0;
}
// Controlla se $ uploadOk è impostato su 0 da un errore
if ($uploadOk == 0) {
    echo "Spiacente, il tuo file non è stato caricato.";
// se tutto è a posto, prova a caricare il file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Spiacente , c'è stato un errore nel caricamento del file.";
    }
    
}


