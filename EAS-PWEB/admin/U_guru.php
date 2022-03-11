<?php

include("../config.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = mysqli_escape_string($db, $_POST['id']);
    $nama = mysqli_escape_string($db, $_POST['nama']);
    $tempat_lahir = mysqli_escape_string($db, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_escape_string($db, $_POST['tanggal_lahir']);
    $id = mysqli_escape_string($db, $_POST['id']);
    $kode_guru = mysqli_escape_string($db, $_POST['kode_guru']);
    $jenis_kelamin = mysqli_escape_string($db, $_POST['jenis_kelamin']);
    $agama = mysqli_escape_string($db, $_POST['agama']);
    $kelas = mysqli_escape_string($db, $_POST['kelas']);
    $mapel = mysqli_escape_string($db, $_POST['mapel']);
    $alamat = mysqli_escape_string($db, $_POST['alamat']);
    $foto = "";
    
    if(!empty($_FILES['foto']['name'])){
        if($_FILES['foto']['size'] > 3*1048576) { //3 MB (size is also in bytes)
            die(json_encode([
                "error" => 500,
                "status" => "File too large (> 3 MB)"
            ]));
            exit;
        }
        
        $filename = $_FILES['foto']['name'];
        
        $location = "../images/".$filename;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
        $imageFileType = strtolower($imageFileType);
        $imageNewFileName = md5(time()).'.'.$imageFileType;
        $location = "../images/".$imageNewFileName;

        $valid_extensions = array("jpg","jpeg","png");
     
        $response = 0;
        /* Check file extension */
        if(in_array(strtolower($imageFileType), $valid_extensions)) {
           /* Upload file */
           if(move_uploaded_file($_FILES['foto']['tmp_name'],$location)){
              $response = $location;
              $foto = $imageNewFileName;
           }
        }else{
            die(json_encode([
                "error" => 500,
                "status" => "Invalid file type"
            ]));
            exit;
        }   
        
        $sql = "SELECT * FROM users WHERE id=$id AND role='guru'";
        $query = mysqli_query($db, $sql);

        $old_foto = "";
        while ($guru = mysqli_fetch_array($query)) {
            $old_foto = $guru["foto"];
            break;
        }
        
        if($old_foto && file_exists($old_foto)){
            unlink($old_foto);
        }

        $sql = "UPDATE users
                SET id=$id, nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', kode_guru='$kode_guru', jenis_kelamin='$jenis_kelamin', agama='$agama', kelas='$kelas', mapel='$mapel', alamat='$alamat', foto='$foto'
                WHERE id=$id";
    } else {
        $sql = "UPDATE users
                SET id=$id, nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', kode_guru='$kode_guru', jenis_kelamin='$jenis_kelamin', agama='$agama', kelas='$kelas', mapel='$mapel', alamat='$alamat'
                WHERE id=$id";
    }

    $query = mysqli_query($db, $sql);
    
    if ($query) {
        die(json_encode([
            "error" => 0,
            "status" => "OK"
        ]));
    } else {
        die(json_encode([
            "error" => 500,
            "status" => "Internal Server Error",
            "message" => mysqli_error($db)
        ]));
    }
}else{
    die("Method not allowed");
}