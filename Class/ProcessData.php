<?php
require_once 'ConnectionString.php';
require_once 'ClassTest.php';
$procesarInfo= new Test();
try{

    $sql= "SELECT Id,Longitud,Latitud FROM testeo2";
    $result = $con->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc())
        {
            $calculo = $procesarInfo->ProcessInformation($row['Latitud'],$row['Longitud'],$row['Id']);

            $data[] = [
                'Id' => $row['Id'],
                'Longitud' => $row['Longitud'],
                'Latitud' => $row['Latitud'],
                'Resultado' => $calculo
            ];

        }
    }



    header('Content-Type: application/json');
    echo json_encode($data);

}catch(PDOException $e)
{
    http_response_code(500);
    echo json_encode(['error'=>'Error en la conexion a la base de datos']);
}
