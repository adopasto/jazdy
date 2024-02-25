<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $vehicle = $_POST["vehicle"];
    $kmBefore = isset($_POST["kmBefore"]) ? $_POST["kmBefore"] : 0;
    $kmAfter = isset($_POST["kmAfter"]) ? $_POST["kmAfter"] : 0;
    $date = $_POST["date"];
    $time1 = $_POST["time1"];
    $time2 = $_POST["time2"];
    $destination = $_POST["destination"];
    $detail = $_POST["detail"];
    $posadka = $_POST["persons"];
    
    $purpose = $_POST["purpose"];
    if ($purpose === "kondicna") {
        $purpose = "Kondičná jazda";
    } elseif ($purpose === "technicka") {
        $purpose = "Technická pomoc";
    } elseif ($purpose === "other") {
        $purpose = "Ostatné";
    } elseif ($purpose === "zasah") {
        $purpose = "Zásah/cvičenie";
    }
    
    $detail = isset($_POST["detail"]) ? $_POST["detail"] : "";

    $servername = "mysql80.r1.websupport.sk";
    $username = "admin_dhzo";
    $password = "Dharma108";
    $dbname = "Zaznam_jazd";

    $conn = new mysqli($servername, $username, $password, $dbname); 

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $conn->set_charset("utf8mb4");
    }

    $sql = "INSERT INTO jazda (Meno, Vozidlo, `KM pred jazdou`, `KM po jazde`, Dátum, `Čas odjazdu`, `Čas príjazdu`, `Cieľ jazdy`, `Účel jazdy`, `Detaily jazdy`, `Posádka`)
        VALUES ('$name', '$vehicle', '$kmBefore', '$kmAfter', '$date', '$time1', '$time2', '$destination', '$purpose', '$detail', '$posadka')";

   if ($conn->query($sql) === TRUE) {
        $response = array('status' => 'success', 'message' => 'Jazda úspešne zaznamenaná!');
        
        /// Redirect to index.html after successful submission
        header("Location: records.html?success=true");
        exit(); // Important: Terminate the script after redirection
    } else {
        $response = array('status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error);
    }

    echo json_encode($response);
}
?>
