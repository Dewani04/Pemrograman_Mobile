<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header('Content-Type: application/json; charset=UTF-8');

include "db_config.php";
$postjson = json_decode(file_get_contents('php://input'), true);
$aksi=strip_tags($postjson['aksi']);
$data    = array();
switch($aksi)

   {
   
    case "add_register":
    $nama = filter_var($postjson['nama'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
$nim = filter_var($postjson['nim'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
$tgl_lahir = filter_var($postjson['tgl_lahir'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
$statuss = filter_var($postjson['statuss'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
$email = filter_var($postjson['email'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 $nomorwa = filter_var($postjson['nomorwa'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 $favoritegirlboy = filter_var($postjson['favoritegirlboy'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 $jenis_kelamin = filter_var($postjson['jenis_kelamin'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 try {
 $sql = "INSERT INTO rekayasa
 (nama,nim,tgl_lahir,statuss,email,nomorwa,favoritegirlboy,jenis_kelamin) VALUES
 (:nama,:nim,:tgl_lahir, :statuss, :email, :nomorwa, :favoritegirlboy, :jenis_kelamin)";
 $stmt = $pdo->prepare($sql);
 $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
 $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
 $stmt->bindParam(':tgl_lahir', $tgl_lahir, PDO::PARAM_STR);
 $stmt->bindParam(':statuss', $statuss, PDO::PARAM_STR);
 $stmt->bindParam(':email', $email, PDO::PARAM_STR);
 $stmt->bindParam(':nomorwa', $nomorwa, PDO::PARAM_STR);
 $stmt->bindParam(':favoritegirlboy', $favoritegirlboy, PDO::PARAM_STR);
 $stmt->bindParam(':jenis_kelamin', $jenis_kelamin, PDO::PARAM_STR);
 $stmt->execute();
 if($sql) $result = json_encode(array('success' =>true));

 else $result = json_encode(array('success' => false, 'msg'=>'error ,
please try again'));

 echo $result;
 }
 catch(PDOException $e)
 {
 echo $e->getMessage();
 }
 break;
 case "getdata":
 $limit = filter_var($postjson['limit'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 $start = filter_var($postjson['start'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 try {
 $sql = "SELECT * FROM rekayasa ORDER BY id DESC LIMIT :start,:limit";
 $stmt = $pdo->prepare($sql);
 $stmt->bindParam(':start', $start, PDO::PARAM_STR);
 $stmt->bindParam(':limit', $limit, PDO::PARAM_STR);
 $stmt->execute();
 $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
 foreach($rows as $row){
 $data[] = array(
 'id' => $row['id'],
 'nama' => $row['nama'],
 'nim' => $row['nim'],
 'tgl_lahir' => $row['tgl_lahir'],
 'statuss' => $row['statuss'],
 'email' => $row['email'],
 'nomorwa' => $row['nomorwa'],
 'favoritegirlboy' => $row['favoritegirlboy'],
 'jenis_kelamin' => $row['jenis_kelamin'],
 );
 }
 if($stmt) $result = json_encode(array('success'=>true,
'result'=>$data));
 else $result = json_encode(array('success'=>false));

 echo $result;
 }
 catch(PDOException $e)
 {
 echo $e->getMessage();
}

break;
}