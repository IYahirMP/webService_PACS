<?php

include 'conexion.php';

$pdo = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id'])) {
        $sql = $pdo->prepare("select * from organigrama where ID_ORGANIGRAMA=:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit;
    } else {

        $sql = $pdo->prepare("select * from organigrama");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = $pdo->prepare("insert into 
        organigrama(AREA, DESCRIPCION, AREA_DEPENDE, NIVEL, TIPO_AREA, TITULAR) 
        values (:area, :descripcion, :area_depende, :nivel, :tipo_area, :titular)");
    $sql->bindValue(':area', $_POST['area']);
    $sql->bindValue(':descripcion', $_POST['descripcion']);
    $sql->bindValue(':area_depende', $_POST['area_depende']);
    $sql->bindValue(':nivel', $_POST['nivel']);
    $sql->bindValue(':tipo_area', $_POST['tipo_area']);
    $sql->bindValue(':titular', $_POST['titular']);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $id = $pdo->lastInsertId();

    if ($id) {
        header("HTTP/1.1 200 OK");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $sql = $pdo->prepare(
        "update organigrama set
        AREA=:area, 
        DESCRIPCION=:descripcion, 
        AREA_DEPENDE=:area_depende, 
        NIVEL=:nivel, 
        TIPO_AREA=:tipo_area,
        TITULAR=:titular
        where ID_ORGANIGRAMA=:id"
    );
    $sql->bindValue(':area', $_GET['area']);
    $sql->bindValue(':descripcion', $_GET['descripcion']);
    $sql->bindValue(':area_depende', $_GET['area_depende']);
    $sql->bindValue(':nivel', $_GET['nivel']);
    $sql->bindValue(':tipo_area', $_GET['tipo_area']);
    $sql->bindValue(':titular', $_GET['titular']);
    $sql->bindValue(':id', $_GET['id']);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);

    if ($sql) {
        header("HTTP/1.1 200 OK");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $sql = $pdo->prepare(
        "delete from organigrama where ID_ORGANIGRAMA=:id"
    );
    $sql->bindValue(':id', $_GET['id']);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);

    if ($sql) {
        header("HTTP/1.1 200 OK");
        exit;
    }
}

header("HTTP/1.1 400 Bad request");
exit;
