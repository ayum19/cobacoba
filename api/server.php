<?php

//Buat table dengan nama kota (prov VARCHAR(64), kota VARCHAR(64)), primary keynya kota.
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'tpppweb';


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

//Create db if not exists
$db = new mysqli($hostname, $username, $password, $database); //connect ke database
if(isset($_POST['tambahprov']) && isset($_POST['tambahkota'])){

    $prov = $_POST['tambahprov'];
    $kota = $_POST['tambahkota'];
    $sql = "INSERT INTO kota(provinsi, kota) VALUES('$prov', '$kota');";
    $db->query($sql);
    if($db->affected_rows > 0){
        echo 'Kota berhasil didaftarkan';
    }else{
        echo 'Kota gagal didaftarkan';
    }
} else if(isset($_GET['prov'])){
    $prov = $_GET['prov'];
    $result = $db->query('SELECT * FROM kota WHERE provinsi= "'.$prov.'"');
    $data = [];
    if(is_object($result) && $result->num_rows > 0 ){
        while($row = $result->fetch_assoc()){
            $data[] = $row['kota'];
        }
    }
    echo json_encode($data);
}






?>