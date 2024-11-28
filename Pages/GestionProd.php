
<?php
session_start();
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$conn =  mysqli_connect($Server, $User, $Pwd, $BD);
$sql = "Select * from Articulos";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['Id_Art'],
            'name' => $row['Nombre'],
            'alto' => $row['Alto'],
            'largo' => $row['Largo'],
            'fondo' => $row['Fondo'],
            'material' => $row['Material'],
            'category' => $row['Categoria'],
            'image' => $row['Imagen'],
            'price' => $row['Precio'],
            'exist' => $row['Existencias'],
        ];
    }
}

#$conn->close();
#Arreglo asociativo para los productos.
/* $products = [
    ['id' => 1, 'name' => 'Cómoda de 3 cajones', 'price' => 1300],
    ['id' => 2, 'name' => 'Cómoda de 4 cajones', 'price' => 1400],
    ['id' => 3, 'name' => 'Cómoda de 5 cajones', 'price' => 2000],
    ['id' => 4, 'name' => 'Cómoda de 6 cajones', 'price' => 2400],
    ['id' => 5, 'name' => 'Cómoda de 9 cajones', 'price' => 3500],
    ['id' => 6, 'name' => 'Buró de 1 cajón liso', 'price' => 600],
    ['id' => 7, 'name' => 'Buró de 2 cajones liso', 'price' => 600],
    ['id' => 8, 'name' => 'Buró de 2 cajones tallado', 'price' => 600],
    ['id' => 9, 'name' => 'Buró de 3 cajones liso', 'price' => 900],
    ['id' => 10, 'name' => 'Credenza chica de 2 cajones lisa', 'price' => 900],
    ['id' => 11, 'name' => 'Credenza grande de 2 cajones lisa', 'price' => 1000],
    ['id' => 12, 'name' => 'Credenza chica de 2 cajones tallada estilo alcatraz en alto relieve', 'price' => 1200],
    ['id' => 13, 'name' => 'Credenza grande de 3 cajones tallada estilo alcatraz en alto relieve', 'price' => 1500],
    ['id' => 14, 'name' => 'Credenza chica de 2 cajones talla estilo medallón', 'price' => 1200],
    ['id' => 15, 'name' => 'Credenza grande de 3 cajones talla sencilla', 'price' => 1200],
    ['id' => 16, 'name' => 'Credenza grande de 3 cajones talla estilo red en alto relieve', 'price' => 1500],
]; */
function calculateCartTotal()
{
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['quantity'] * $item['product']['price'];
        }
    }
    return $total;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = ['quantity' => $quantity, 'product' => $products[$product_id - 1]];
        }

        if (isset($_SESSION['cart_count'])) {
            $_SESSION['cart_count'] += $quantity;
        } else {
            $_SESSION['cart_count'] = $quantity;
        }
    } elseif (isset($_POST['clear_cart'])) {
        unset($_SESSION['cart']);
        unset($_SESSION['cart_count']);
    }
}
if($_SESSION['Rol'] == "Empleado"){
    echo '
    <style>
    #Add{
        display:none;
    }
    #FormRemove{
        display:none;
    }
    #BtnVerMás{
        display:none;
    }
    #BtnReady{
        display:none;
    }
    </style>
    ';
}
if($_SESSION['Rol'] == "Administrador"){
    echo '
    <style>
    #BtnDetails{
        display:none;
    }
    </style>
    ';
}
if(!isset($_SESSION['UserP'])){
    header("location: Sesión trabajador.html");
}
?>
<!--Trabajar en las páginas para agregar producto y demás privilegios que tendrian los usuarios.-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de productos</title>
   <!-- Link de jquery para relaizar peticiones de javascript asincronas con AJAX -->
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!--Cambiar el icono de la página en la pestaña superior de búsqueda-->
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--enlace para la hoja de estilos-->
    <link rel="stylesheet" href="StyleGestionProducto2.css">
    <!--Iconos de fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Enlace para la tipografía-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">  

</head>
<body>
    <!-- Modal de confirmación de la edición del producto -->
            <div id="Modal">
            <section class="ModalBack">
                <article class="ModalContent">
                    <span class="MessageCorrect">
                        Mensaje sobre la operación
                    </span>
                    <div class="ModalBody">
                    <span class="ContentModalBoy">
                        <i class="fa-regular fa-circle-check" id="Correct"></i>
                        <hr>
                        <br>
                        <span class="MessageModalBody">
                            El producto se ha actualizado correctamente!!
                        </span>
                    </span>
                </div>
                </article>
            </section>
        </div>
    <!-- Fin del modal -->


    <!-- Maquetado de la estructura del encabezado -->
<table class="head" id="Head">
        <tr>
            <td class="head" id="Logo">
                <img src="../Img/Logo.png" alt="Logo_Carp">
            </td>
            <td class="head" id="ContentTitulo">
                <span id="Titulo">Sesión de trabajador: gestión de productos</span>
            </td>
            <td class="head" id="ContentBtn">
                <button id="Regresar">
                    <i class="fa-solid fa-arrow-left"></i>
                    <a href="PanelT.php">Volver</a>
                </button>
            </td>

        </tr>
    </table>
    <!-- Add -->
    <!-- Estilizar -->
    <button id="Add"><i class="fa-solid fa-plus"></i> <a href="AddProd.php"> Añadir producto</a></button>
    <p id="TitleF">Filtrar por número de existencias: </p>
    <hr>
    <div id="ContForm">
        <form method="GET" action="GestionProd.php">
            <label for="minExist" class="FilterMsg">Mínimo de Existencias:</label>
            <input class="FilterQ" type="number" id="minExist" name="minExist" min="0" value="<?php echo isset($_GET['minExist']) ? $_GET['minExist'] : 0; ?>">
            <br class="breakRow">
            <label for="maxExist" class="FilterMsg" id="MaxEx">Máximo de Existencias:</label>
            <br class="breakRow">
            <input class="FilterQ" type="number" id="maxExist" name="maxExist" min="0" value="<?php echo isset($_GET['maxExist']) ? $_GET['maxExist'] : ''; ?>">
            <br class="breakRow">
            <br class="breakRow">
            <button type="submit" id="BtnFilter"><i class="fa-solid fa-filter"></i> Filtrar</button>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn" id="QuitFilter"><i class="fa-solid fa-ban"></i> Quitar filtros</a>
        </form>
    </div>
    <!-- Estilizar -->

<?php
$minExist = isset($_GET['minExist']) ? intval($_GET['minExist']) : 0;
$maxExist = isset($_GET['maxExist']) ? intval($_GET['maxExist']) : PHP_INT_MAX;
?>

<table id="ContentAll">
    <tr>
        <?php 
        $productCount = 0; 
        foreach ($products as $product) : 
            if ($product['exist'] >= $minExist && $product['exist'] <= $maxExist) :
        ?>
            <td class="Art">
                <section class="Producto">
                    <article class="Contenido">
                        <label id="TitleModalProducto">Nombre: <?php echo $product['name']; ?> </label>
                        <hr>
                        <br>
                        <img src="../Img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="ImgProd">
                        <br>
                        <br>
                        <div class="Datos" id="PriceModal"><?php echo 'Precio: $', $product['price']; ?></div>
                        <br>
                        <div class="Datos" id="Category"><?php echo 'Categoria: ', $product['category']; ?></div>
                        <br>
                        <div class="Datos" id="Exist"><?php echo 'Inventario: ', $product['exist']; ?></div>
                        <br>
                        <div class="Datos" id="MedidasModal">Medidas:
                            <ul>
                                <li>Alto: <?php echo $product['alto']; ?></li>
                                <li>Largo: <?php echo $product['largo']; ?></li>
                                <li>Fondo: <?php echo $product['fondo']; ?></li>
                            </ul>
                        </div>
                        <button type="button" onclick="openCustomModalEmp('<?php echo $product['id']; ?>')" id="BtnDetails"><i class="fa-solid fa-circle-info"></i> Ver detalles</button>
                        <button type="button" onclick="openCustomModal('<?php echo $product['id']; ?>')" id="BtnVerMás"><i class="fa-solid fa-pencil"></i> Editar</button>
                        <form action="RemoveProd.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar este producto?');" id="FormRemove">
                            <input type="hidden" value="<?php echo $product['id']; ?>" name="IdProd">
                            <button type="submit" id="DeleteProd"><i class="fa-solid fa-ban"></i> Borrar</button>
                        </form>
                    </article>
                </section>
            </td>

            <?php
                $productCount++;
                if ($productCount == 2) {
                    echo '</tr><tr>';
                    $productCount = 0;
                }
            ?>
        <?php 
            endif;
        endforeach; 
        ?>

        <?php if ($productCount % 2 != 0) : // Añadir celda vacía si el número de productos no es par ?>
            <td class="Art"></td>
        <?php endif; ?>
        <?php if ($productCount == 0) :?>
            <style>#ContentAll{display:none;}</style>
            <p id="MsgNoEx">No hay productos disponibles con las existencias especificadas.</p>
            <?php else: echo '<style>#MsgNoEx{display:none;}</style>';?>
        <?php endif; ?>
    </tr>
</table>


<!-- Add --> 
    <?php foreach ($products as $product) : ?>
    <!-- Modal dinámico para cada producto -->
    <div class="custom-modal" id="myModal<?php echo $product['id']; ?>">
    <div>
        <div class="modal-overlay" onclick="closeCustomModal('<?php echo $product['id']; ?>')"></div>
    </div>
        <div class="modal-content">
            <div class="ModalHead">
                <span id="CloseModalDn" onclick="closeCustomModal('<?php echo $product['id']; ?>')">&times;</span>
            </div>
            <h5 class="modal-title">Detalles del producto - <?php echo $product['name']; ?></h5>

            <form action="EditProd.php" method="POST" id="FormEditPr_<?php echo $product['id']; ?>" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" value="<?php echo $product['id']?>" name="id">
                <label class="TituloArt" style="font-weight: 400;">Nombre: </label><input type="text" value="<?php echo $product['name']; ?>" name="name" class="InputForm">
                <hr>
                <label class="TituloArt" style="font-weight: 400;">Precio:  $</label><input type="text" value="<?php echo $product['price']; ?>" name="price" class="InputForm">
                <hr style="font-weight: 900; color: black; width: 85%;">
                <label class="CategoriaArt" style="font-weight: 500;">Categoria: </label><input type="text" value="<?php echo $product['category']; ?>" name="category" class="InputForm">
                <hr style="font-weight: 900; color: black; width: 90%;">
                <label class="CategoriaArt" style="font-weight: 500;">Inventario: </label><input type="number" value="<?php echo $product['exist']; ?>" name="inventary" class="InputForm">
                <hr style="font-weight: 900; color: black; width: 90%;">
                <label class="Medidas">Medidas:</label><ul>
                                <li>Alto: <input type="text" value="<?php echo $product['alto']; ?>" name="alto" class="InputForm"></li>
                                <li>Largo: <input type="text" value="<?php echo $product['largo']; ?>" name="largo" class="InputForm" id="InputMiddle"></li>
                                <li>Fondo: <input type="text" value="<?php echo $product['fondo']; ?>" name="fondo" class="InputForm"></li>
                                <!--<li>Id: <input type="text" value="" name="fondo" class="InputForm"></li>-->
                            </ul>
                <hr style="font-weight: 900; color: black; width: 90%;">
            <!--    <label for="Imagen" class="TitleReq">Imagen: </label>
                <input type="file" name="Imagen" id="Imagen" accept="image/*" class="BreakRow" >                
                <hr> -->
            </div>
            <button type="submit" class="BtnFromModal" id="BtnReady"><i class="fa-solid fa-check"></i> Listo</button>
            </form>

            <div class="modal-footer">
                <button type="button" class="BtnFromModal" id="BtnClose" onclick="closeCustomModal('<?php echo $product['id']; ?>')"><i class="fa-solid fa-xmark"></i> Cerrar</button>
            </div>
        </div>
    </div>
    <!--Fin del modal dinámico para detalles del producto-->
<?php endforeach; ?>

<?php foreach ($products as $product) : ?>
    <!-- Modal dinámico para cada producto en la sesión de empleado -->
    <div class="custom-modalE" id="ModalEmp<?php echo $product['id']; ?>">
    <div>
        <div class="modal-overlay" onclick="closeCustomModalEmp('<?php echo $product['id']; ?>')"></div>
    </div>
        <div class="modal-content">
            <div class="ModalHead">
                <span id="CloseModalDn" onclick="closeCustomModalEmp('<?php echo $product['id']; ?>')">&times;</span>
            </div>
            <h5 class="modal-title">Detalles del producto - <?php echo $product['name']; ?></h5>

            <div class="modal-body">
                <input type="hidden" value="<?php echo $product['id']?>" name="id">
                <label class="TituloArt" style="font-weight: 400;">Nombre: <?php echo $product['name']; ?></label>
                <hr>
                <label class="TituloArt" style="font-weight: 400;">Precio:  $<?php echo $product['price']; ?></label>
                <hr style="font-weight: 900; color: black; width: 85%;">
                <label class="TituloArt" style="font-weight: 400;">Material: <?php echo $product['material']; ?></label>
                <hr style="font-weight: 900; color: black; width: 85%;">
                <label class="CategoriaArt" style="font-weight: 500;">Categoria: <?php echo $product['category']; ?></label>
                <hr style="font-weight: 900; color: black; width: 90%;">
                <input type="hidden" name="image" value="<?php echo $product['image'];?>">
                <label class="Medidas" style="font-weight: 600;">Medidas:</label><ul>
                                <li>Alto:<?php echo $product['alto']; ?></li>
                                <li>Largo: <?php echo $product['largo']; ?></li>
                                <li>Fondo: <?php echo $product['fondo']; ?></li>
                            </ul>
            </div>
            <!-- <button type="submit" class="BtnFromModal" id="BtnReady"><i class="fa-solid fa-check"></i> Listo</button> -->


            <div class="modal-footer">
                <button type="button" class="BtnFromModal" id="BtnClose" onclick="closeCustomModalEmp('<?php echo $product['id']; ?>')"><i class="fa-solid fa-xmark"></i> Cerrar</button>
            </div>
        </div>
    </div>
    <!--Fin del modal dinámico para detalles del producto-->
<?php endforeach; ?>

<script>
$(document).ready(function() {
    // Obtener todos los formularios que tengan un ID que comienza con "FormEditPr_"
    $('form[id^="FormEditPr_"]').submit(function(event) {
        event.preventDefault(); // Evitar el envío tradicional del formulario

        // Obtener el ID específico del formulario dinámicamente
        var formId = $(this).attr("id");

        // Petición AJAX
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            success: function(response) {
                // Muestra el modal cuando la respuesta es exitosa
                $("#Modal").show();

                // Cierra el modal después de 2 segundos
                setTimeout(function() {
                    $("#Modal").hide();
                    location.reload(); //Se recarga la página
                }, 1000);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
});

// Funciones para los modales dinámicos en la sesión de trabajador empleado.
function openCustomModalEmp(id) {
        document.getElementById('ModalEmp' + id).style.display = 'block';

    }

    function closeCustomModalEmp(id) {
        document.getElementById('ModalEmp' + id).style.display = 'none';
    }
// Funciones para los modales dinámicos en la sesión de trabajador Admin.
function openCustomModal(id) {
        document.getElementById('myModal' + id).style.display = 'block';
    }

    function closeCustomModal(id) {
        document.getElementById('myModal' + id).style.display = 'none';
    }
// Funciones para el modal del carrito en la sesión de cliente.
        function openModal(carritoModal) {
            document.getElementById("carritoModal").style.display = "block";
            document.getElementById("ContentModalCarrito").style.display="block";
        }

        function closeModal(carritoModal) {
            document.getElementById("carritoModal").style.display = "none";
            document.getElementById("ContentModalCarrito").style.display="none";
        }
    </script>
</body>
</html>