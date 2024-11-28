<?php
session_start();
$IdClient = $_SESSION['IdUser'];
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$DeudaCA = "Select Deuda from Clientes where Id_Cliente = $IdClient";
$Result = mysqli_query($Conexion, $DeudaCA);
$Field = mysqli_fetch_array($Result);
$Deuda = $Field['Deuda'];
date_default_timezone_set('America/Mexico_City');
$Json = file_get_contents('php://input');
$Datos = json_decode($Json,true);
if(is_array($Datos)){
    $Id = $Datos['detalles']['id'];
    $Monto = $Datos['detalles']['purchase_units'][0]['amount']['value'];
    $Fecha = $Datos['detalles']['update_time'];
    $Fecha_N = date('Y-m-d H:i:s', strtotime($Fecha));
    $Email = $Datos['detalles']['payer']['email_address'];
}
// Add
if (isset($_GET['amount'])) { #Se comprueba si hay algo en el GET que recibir para hacer las adiciones.
    $amount = $_GET['amount'];
    $Monto = $amount;
    $fecha = date('Y-m-d H:i:s');
    $Fecha_N = $fecha;
}
// Solo comprobación:
// echo $IdClient;
// echo '<br>';
// echo $Id;
// echo '<br>';
// echo $Monto;
// echo '<br>';
// echo $Fecha_N;
// echo '<br>';
// echo $Email;
// echo '<br>';
// echo $Deuda;
$DeudaFinal = $Deuda + $Monto;
// echo '<br>';
// echo $DeudaFinal;
// echo $IdClient;

foreach ($_SESSION['productNames'] as $product) {
        $productInfo[] = $product->name . " (" . $product->quantity . ")";
    }
$StrProd = implode(", ", $productInfo); //Convertit el arreglo a cadena.
// $IdClient = $_SESSION['IdUser'];


$State = $_SESSION['State'];
// $StrProd = implode(', ',$_SESSION['productNames']);// Convertir un arreglo a cadena.
// echo "Insert into Pedidos values ('', $IdClient, '$StrProd', '$State', '$Fecha_N', '$Monto')";
// $escapedStrProd = mysqli_real_escape_string($Conexion, $StrProd);
if ($State == "Liquidado") {
    $Insert = "INSERT INTO Pedidos VALUES ('', $IdClient, '$StrProd', '$State', 'En proceso', '$Fecha_N', '$Monto', '0.00')";
    $Execute = mysqli_query($Conexion, $Insert);

    if ($Execute) {
        foreach ($_SESSION['cart'] as $product) {
            $productId = $product['product']['id'];
            $quantity = $product['quantity'];
            $query = "SELECT Existencias FROM Articulos WHERE Id_Art = $productId";
            $result = mysqli_query($Conexion, $query);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $currentStock = $row['Existencias'];
                $newStock = $currentStock - $quantity;
                
                // Construcción correcta de la consulta de actualización
                $updateStock = "UPDATE Articulos SET Existencias = $newStock WHERE Id_Art = $productId";
                $updateResult = mysqli_query($Conexion, $updateStock);
                
                if (!$updateResult) {
                    echo "Error al actualizar existencias para el artículo con ID $productId: " . mysqli_error($Conexion);
                }
            } else {
                echo "No se encontró el artículo con ID $productId en la base de datos.";
            }
        }
        
        unset($_SESSION['cart']);
        unset($_SESSION['cart_count']);
        header("refresh:0;url=http://localhost/ProyectoHost/index.php");
    } else {
        echo "Error al insertar el pedido: " . mysqli_error($Conexion);
    }
}else if($State == "Pendiente"){
    // Insertar el pedido
    $InsertA = "INSERT INTO Pedidos VALUES ('', $IdClient, '$StrProd', '$State', 'En proceso', '$Fecha_N', '$Monto', '$Monto')";
    $ExecuteA = mysqli_query($Conexion, $InsertA);

    // Actualizar la deuda del cliente
    $UpdateDebt = "UPDATE Clientes SET Deuda = '$DeudaFinal' WHERE Id_Cliente = $IdClient";
    $ExecuteDebt = mysqli_query($Conexion, $UpdateDebt);

    // Actualizar el stock de productos
    foreach ($_SESSION['cart'] as $product) {
        $productId = $product['product']['id'];
        $quantity = $product['quantity'];
        $queryStock = "SELECT Existencias FROM Articulos WHERE Id_Art = $productId";
        $resultStock = mysqli_query($Conexion, $queryStock);
        if ($resultStock && mysqli_num_rows($resultStock) > 0) {
            $rowStock = mysqli_fetch_assoc($resultStock);
            $currentStock = $rowStock['Existencias'];
            $newStock = $currentStock - $quantity;

            // Actualizar el stock en la tabla de Articulos
            $updateStock = "UPDATE Articulos SET Existencias = $newStock WHERE Id_Art = $productId";
            mysqli_query($Conexion, $updateStock);
        }
    }

    // Limpiar la sesión y redirigir al usuario
    unset($_SESSION['cart']);
    unset($_SESSION['cart_count']);
    unset($_SESSION['Cant']);
    header("refresh:0;url=http://localhost/ProyectoHost/index.php");
}



// Trabajar en la tabla de abonos, la tabla de pedidos pendientes y todas las funcionalidades que conlleva ya tener pedidos pendientes en el sitio.
// Trabajar en la subida al servidor de los cambios que se hicieron y agregar las categorias pendientes junto con sus estilos.



// $Revisar = "Select * from Pedidos";
// $resultado = mysqli_query($Conexion, $Revisar);

// while ($Resultado = mysqli_fetch_assoc($resultado)) {
//     foreach ($Resultado as $clave => $valor) {
//         echo $clave . ": " . $valor . "<br>";
//     }
//     echo "<br>";
// }

?>

<!-- Array
(
    [detalles] => Array
        (
            [id] => 39476258218561520
            [intent] => CAPTURE
            [status] => COMPLETED
            [purchase_units] => Array
                (
                    [0] => Array
                        (
                            [reference_id] => default
                            [amount] => Array
                                (
                                    [currency_code] => MXN
                                    [value] => 1200.00
                                )

                            [payee] => Array
                                (
                                    [email_address] => sb-pa0oq29000891@business.example.com
                                    [merchant_id] => SNRH9VR37U5RC
                                )

                            [soft_descriptor] => PAYPAL *TEST STORE
                            [shipping] => Array
                                (
                                    [name] => Array
                                        (
                                            [full_name] => John Doe
                                        )

                                    [address] => Array
                                        (
                                            [address_line_1] => Calle Juarez 1
                                            [address_line_2] => Col. Cuauhtemoc
                                            [admin_area_2] => Miguel Hidalgo
                                            [admin_area_1] => Ciudad de Mexico
                                            [postal_code] => 11580
                                            [country_code] => MX
                                        )

                                )

                            [payments] => Array
                                (
                                    [captures] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [id] => 0G649470FV477132N
                                                    [status] => COMPLETED
                                                    [amount] => Array
                                                        (
                                                            [currency_code] => MXN
                                                            [value] => 1200.00
                                                        )

                                                    [final_capture] => 1
                                                    [seller_protection] => Array
                                                        (
                                                            [status] => ELIGIBLE
                                                            [dispute_categories] => Array
                                                                (
                                                                    [0] => ITEM_NOT_RECEIVED
                                                                    [1] => UNAUTHORIZED_TRANSACTION
                                                                )

                                                        )

                                                    [create_time] => 2024-01-03T14:52:24Z
                                                    [update_time] => 2024-01-03T14:52:24Z
                                                )

                                        )

                                )

                        )

                )

            [payer] => Array
                (
                    [name] => Array
                        (
                            [given_name] => John
                            [surname] => Doe
                        )

                    [email_address] => sb-adqpt29001003@personal.example.com
                    [payer_id] => 2H5RPMCSPLX3C
                    [address] => Array
                        (
                            [country_code] => MX
                        )

                )

            [create_time] => 2024-01-03T14:52:16Z
            [update_time] => 2024-01-03T14:52:24Z
            [links] => Array
                (
                    [0] => Array
                        (
                            [href] => https://api.sandbox.paypal.com/v2/checkout/orders/39476258218561520
                            [rel] => self
                            [method] => GET
                        )

                )

        )

) -->