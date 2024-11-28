<?php

// Función para obtener los resultados desde la base de datos
function obtenerResultadosDesdeLaBD($searchTerm)
{
    $Server = "localhost";
    $User = "root";
    $Pwd = "";
    $BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);

    if (!$Conexion) {
        die("La conexión falló: " . mysqli_connect_error());
    }

    $searchTerm = mysqli_real_escape_string($Conexion, $searchTerm);

    $Consulta = "Select * From Articulos Where Nombre Like '%$searchTerm%'";
    $result = $Conexion->query($Consulta);

    $results = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $results[] = [
                'id' => $row['Id_Art'],
                'name' => $row['Nombre'],
                'alto' => $row['Alto'],
                'largo' => $row['Largo'],
                'fondo' => $row['Fondo'],
                'material' => $row['Material'],
                'category' => $row['Categoria'],
                'image' => $row['Imagen'],
                'price' => $row['Precio'],
            ];
        }
    }

    mysqli_close($Conexion);

    return $results;
}
if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];
    $results = obtenerResultadosDesdeLaBD($searchTerm);

    if (!empty($results)) {
        echo "<ul class='search-results'>";
        foreach ($results as $result) {
            echo "<li class='search-result' data-product-id='{$result['id']}'>";
            echo "<i class='fa-solid fa-magnifying-glass'></i><span id='ResultName'>" . $result['name']."</span>";
            echo "</li>";
        }        
        echo "</ul>";
    } else {
        echo "<p>No se encontraron resultados</p>";
    }
} 

?>
