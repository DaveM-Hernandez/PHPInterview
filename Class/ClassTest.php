<?php


class Test{


    public function importData($ruta)
    {
        require_once 'ConnectionString.php';
        
$file = fopen($ruta,"r");
$sql = "INSERT INTO testeo2 (Latitud,Longitud,Id,Titulo,Anunciante,Descripcion,Reformado,
Telefonos,Tipo,Precio,PrecioPorMetro,Direccion,Provincia,Ciudad,
MetrosCuadrados,Habitacion,Bathroom,Parking,SegundaMano,ArmariosEmpotrados,
ConstruidosEn,Amueblados,CalefaccionIndividual,CertificacionEnergetica,Planta,Exterior,
Interior,Ascensor,Fecha,Calle,Barrio,Distrito,Terraza,Trastero,CocinaEquipada,AireAcondicionada,
Piscina,Jardin,MetrosCuadradosUtiles,AptoConMovilidadReducida,Plantas,AdmitenMascotas, Balcon) 
VALUES (?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        
        
        $stmt = $con->prepare($sql);
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $con->error);
        }
        $stmt->bind_param(
            "ssissssssidsssiiisssisssisssssssssssssisiss",
            $latitud, $longitud, $id, $titulo, $anunciante, $descripcion, $reformado, $telefonos, $tipo, $precio, $precioPorMetro, $direccion, $provincia, $ciudad, $metrosCuadrados, $habitacion, $bathroom, $parking, $segundaMano, $armariosEmpotrados, $construidosEn, $amueblados, $calefaccionIndividual, $certificacionEnergetica, $planta, $exterior, $interior, $ascensor, $fecha, $calle, $barrio, $distrito, $terraza, $trastero, $cocinaEquipada, $aireAcondicionado, $piscina, $jardin, $metrosCuadradosUtiles, $aptoConMovilidadReducida, $plantas, $admitenMascotas, $balcon
        );

       
        
        while (($data = fgetcsv($file, 0, ',')) !== FALSE) 
        {

    $latitud = !empty($data[0]) ? $data[0] : NULL;
    $longitud = !empty($data[1]) ? $data[1] : NULL;
    $id = !empty($data[2]) ? (int)$data[2] : NULL;
    $titulo = !empty($data[3]) ? $data[3] : NULL;
    $anunciante = !empty($data[4]) ? $data[4] : NULL;
    $descripcion = !empty($data[5]) ? $data[5] : NULL;
    $reformado = !empty($data[6]) ? $data[6] : NULL;
    $telefonos = !empty($data[7]) ? $data[7] : NULL;
    $tipo = !empty($data[8]) ? $data[8] : NULL;
    $precio = !empty($data[9]) ? (int)$data[9] : NULL;
    $precioPorMetro = !empty($data[10]) ? (float)$data[10] : NULL;
    $direccion = !empty($data[11]) ? $data[11] : NULL;
    $provincia = !empty($data[12]) ? $data[12] : NULL;
    $ciudad = !empty($data[13]) ? $data[13] : NULL;
    $metrosCuadrados = !empty($data[14]) ? (int)$data[14] : NULL;
    $habitacion = !empty($data[15]) ? (int)$data[15] : NULL;
    $bathroom = !empty($data[16]) ? (int)$data[16] : NULL;
    $parking = !empty($data[17]) ? $data[17] : NULL;
    $segundaMano = !empty($data[18]) ? $data[18] : NULL;
    $armariosEmpotrados = !empty($data[19]) ? $data[19] : NULL;
    $construidosEn = !empty($data[20]) ? (int)$data[20] : NULL;
    $amueblados = !empty($data[21]) ? $data[21] : NULL;
    $calefaccionIndividual = !empty($data[22]) ? $data[22] : NULL;
    $certificacionEnergetica = !empty($data[23]) ? $data[23] : NULL;
    $planta = !empty($data[24]) ? (int)$data[24] : NULL;
    $exterior = !empty($data[25]) ? $data[25] : NULL;
    $interior = !empty($data[26]) ? $data[26] : NULL;
    $ascensor = !empty($data[27]) ? $data[27] : NULL;
    $fecha = !empty($data[28]) ? $data[28] : NULL;
    $calle = !empty($data[29]) ? $data[29] : NULL;
    $barrio = !empty($data[30]) ? $data[30] : NULL;
    $distrito = !empty($data[31]) ? $data[31] : NULL;
    $terraza = !empty($data[32]) ? $data[32] : NULL;
    $trastero = !empty($data[33]) ? $data[33] : NULL;
    $cocinaEquipada = !empty($data[34]) ? $data[34] : NULL;
    $aireAcondicionado = !empty($data[36]) ? $data[36] : NULL;
    $piscina = !empty($data[37]) ? $data[37] : NULL;
    $jardin = !empty($data[38]) ? $data[38] : NULL;
    $metrosCuadradosUtiles = !empty($data[39]) ? (int)$data[39] : NULL;
    $aptoConMovilidadReducida = !empty($data[40]) ? $data[40] : NULL;
    $plantas = !empty($data[41]) ? (int)$data[41] : NULL;
    $admitenMascotas = !empty($data[42]) ? $data[42] : NULL;
    $balcon = !empty($data[43]) ? $data[43] : NULL;
    $stmt->execute();


        }


        fclose($file);
        $stmt->close();
        $con->close();
        echo "Conexión cerrada";


    }

       
    public function ProcessInformation($lat,$lon,$id)

        {
            $servername = "localhost";
            $username = "root";
            $database = "interview";
            $con = new mysqli($servername,$username,'',$database);
            

        $sql = "
            SELECT AVG(Precio / MetrosCuadrados) AS PrecioPromedioPorMetroCuadrado
            FROM testeo2
            WHERE Id = ?
        ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        

        // Devolver el resultado
        return $row['PrecioPromedioPorMetroCuadrado'];



        }


    }





















?>