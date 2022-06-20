<?php
require_once "koneksi.php";

if (function_exists($_GET['karyawan'])) {
    $_GET['karyawan']();
}

function get_karyawan(){
    global $connect;

    $query = $connect->query("SELECT * FROM karyawan");

    while($row=mysqli_fetch_object($query)){
        $data[] = $row;
    }

    $response = array(
        'status' => 1,
        'message' => 'Success',
        'data' => $data
    );

    header('Content-Type: aplication/json');
    echo json_encode($response);
}

function get_karyawan_id(){
    global $connect;

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    $query = "SELECT * FROM karyawan WHERE id =  $id";
    $result = $connect->query($query);

    while ($row = mysqli_fetch_object($result)) {
        $data[] = $row;
    }

    if ($data) {
        $response = array(
            'status' => 1,
            'message' => 'success',
            'data' => $data
        );
    }else {
        $response=array(
            'status' => 0,
            'message' => 'No Data Found'        
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function insert_karyawan(){
    global $connect;
    $check = array('id' => '', 'nama' => '', 'jenis_kelamin' => '', 'alamat' => '');
    $check_match = count(array_intersect_key($_POST, $check));

    if ($check_match == count($check)) {
        $result = mysqli_query($connect, "INSERT INTO karyawan SET id = '$_POST[id]', nama = '$_POST[nama]', jenis_kelamin = '$_POST[jenis_kelamin]', alamat = '$_POST[alamat]' ");
        
        if ($result) {
            $response = array(
                'status' => 1,
                'message' => 'Insert success'
            );
        }else {
            $response = array(
                'status' => 0,
                'message' => 'Insert Fail'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Wrong Parameters'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function update_karyawan(){
    global $connect;

    if (!empty($_GET["id"])) {
        $id = $_GET["id"];
    }
    $check = array('nama' => '', 'jenis_kelamin' => '', 'alamat' => '');
    $check_match = count(array_intersect_key($_POST, $check));
    if ($check_match == count($check)) {
        $result = mysqli_query($connect, "UPDATE karyawan SET nama = '$_POST[nama]', jenis_kelamin = '$_POST[jenis_kelamin]', alamat = '$_POST[alamat]' WHERE id = $id");

        if ($result) {
            $response = array(
                'status' => 1,
                'message' => 'Update success'
            );
        }else {
            $response = array(
                'status' => 0,
                'Update' => 'Update failed'
            );
        }
    }else {
        $response = array(
            'status' => 0,
            'message' => 'Wrong parameters'
        );
    }
    header('Content-Type: aplication/json');
    echo json_encode($response);
}

function delete_karyawan(){
    global $connect;
    $id = $_GE['id'];
    $query = "DELETE FROM karyawan WHERE id = $id";
    
    if (mysqli_query($connect, $query)) {
        $response = array(
            'status' => 1,
            'message' => 'Deleted succes'
        );
    }else {
        $response = array(
            'status' => 0,
            'message' => 'Deleted fail'
        );
    }
    header('Content-Type: application/json');;
    echo json_encode($response);
}