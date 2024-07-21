<?php

require_once 'ConnectionString.php';

try{

    $sql= "SELECT * FROM testeo2 ORDER BY Habitacion ASC, precio ASC";
    $result = $con->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    }


    header('Content-Type: application/json');
    echo json_encode($data);

}catch(PDOException $e)
{
    http_response_code(500);
    echo json_encode(['error'=>'Error en la conexion a la base de datos']);
}

