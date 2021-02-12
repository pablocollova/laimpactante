<?php
header("Content-Type: application/json");
// Si no hay búsqueda, mostrar un arreglo vacío y salir
if (empty($_GET["busqueda"])) {
    echo "[]";
    exit;
}
$bd = include_once "bd.php";
$busqueda = $_GET["busqueda"];

$sentencia = $bd->prepare("select * from usuarios where nombre_usuario like ?");
$sentencia->execute(["%$busqueda%"]);
$usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
echo json_encode($usuarios);

?>

$sentencia = $bd->prepare("INSERT INTO usuarios (nombre_usuario, email, apellido_usuario)
VALUES (?, ?, ?) ");
$sentencia->execute("pabloooxx","sdds","dfdf");