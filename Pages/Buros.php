<?php
session_start();
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Consulta = "Select * from Articulos where Categoria = 'Burós'";
$result = $Conexion->query($Consulta);
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
        ];
    }
}
//Función para calcular el total en el precio de los articulos
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
//Funcion para aumentar el contador del carrito
// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
        $product_name = $_POST['product_name'];
        $quantity = $_POST['quantity'];

        // Buscar el producto por nombre
        $product = array_filter($products, function ($p) use ($product_name) {
            return $p['name'] === $product_name;
        });

        // Obtener el primer elemento del array (el producto)
        $product = reset($product);

        if ($product) {
            $product_id = $product['id'];

            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = ['quantity' => $quantity, 'product' => $product];
            }

            if (isset($_SESSION['cart_count'])) {
                $_SESSION['cart_count'] += $quantity;
            } else {
                $_SESSION['cart_count'] = $quantity;
            }
        }
    } elseif (isset($_POST['clear_cart'])) {
        unset($_SESSION['cart']);
        unset($_SESSION['cart_count']);
    }
}
if(isset($_SESSION['User'])){
    echo '
    <style>
    #S{
        display:block;
    }
    .Log{
        display:none;
    } 
    #ContImage{
        display:none;
    }
    </style>
    ';
}else{
    echo '
    <style>
    #S{
        display:none;
    }
    .Cant{
        display:none;

    }
    #Add{
        display:none;
    }
    #Br{
        display:none;
    }
    .Log{
        display:block;
    } 
    </style>
    ';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoría: Burós</title>
    <!--Enlaces para la tipografía-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@200&display=swap" rel="stylesheet">    
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Afacad&display=swap" rel="stylesheet">
    <!--Cambiar el icono de la página en la pestaña superior de búsqueda--> 
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--Enlace para la hoja de estilos-->
    <link rel="stylesheet" href="StyleCatAll.css">
    <!--Enlace para iconos de fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!---Modal del carrito-->
         <div id="ContentModalCarrito">    
            <div id="ContenedorP">
                <div id="carritoModal">
                    <div class="ModalHead">
                         <span id="closeModal" onclick="closeModal()">&times;</span>
                    </div>
                <span id="TitleModalCart">Carrito de Compras</span>
                <ul>
                            <?php if (isset($_SESSION['cart'])) : ?>
                                <?php foreach ($_SESSION['cart'] as $item) : ?>
                                    <li class="BodyModalCart">
                                        <?php echo $item['product']['name']; ?> -
                                        Cantidad: <?php echo $item['quantity']; ?> -
                                        Subtotal: $<?php echo $item['quantity'] * $item['product']['price']; ?>
                                    </li>
                                <?php endforeach; ?>
                                <li class="BodyModalCart">Total del Carrito: $<?php echo calculateCartTotal(); ?></li>
                                <form aclass="BodyModalCart"ction="Buros.php" method="post">
                                    <button type="submit" name="clear_cart" id="ClearCart"><i class="fa-regular fa-trash-can"></i> Vaciar carrito</button>
                                </form>
                                <button title="Continuar" id="Continue"><i class="fa-solid fa-check-double"></i><a href="Pagos/Pago.php">Continuar</a></button>
                            <?php else : ?>
                                <li class="BodyModalCart">El carrito está vacío</li>
                            <?php endif; ?>
                        </ul>
                        <hr>
                <button onclick="closeModal()"class="BtnClose" title="Cerrar"><i class="fa-solid fa-xmark"></i>Cerrar</button>
             </div>
            </div>
            
        </div>

    <!--Fin del modal del carrito-->
    <div id="Encabezado">
        <table id="ContenidoE">
            <tr>
                <td id="S">
                    <span id="TcC">Carrito de compras</span>
                    <?php 
                    if(isset($_SESSION['TotalC'])){
                        echo $_SESSION['TotalC'];
                    }
                        /*echo $_SESSION['Carrito']['Cantidad'];
                        echo $_SESSION['Carrito']['Titulo'];
                        echo $_SESSION['Carrito']['Precio']; */
                    ?>
                    <br>
                    <section id="ContentCartCount">
                        <div id="cart-count"><?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?></div>
                    </section>
                    <div id="ContentMenu"><i class="fa-solid fa-cart-plus fa-flip-horizontal" id="IconoCarrito" onclick="openModal()" title="Abrir carrito de compras"></i></div>
                </td>

                <td class="ContEncabezado" id="ContImage">
                    <img src="../Img/LogoCarp.png" alt="LogoTipo" title="Logo_CVM-M">
                </td>
                <td class="ContEncabezado" id="ContTitle">
                    <span>Categoría: Burós</span>
                </td>
                <td class="ContEncabezado" id="ContBtn">
                    <button id="BtnRegresar"> 
                        <i class="fa-solid fa-arrow-left-long"></i>
                        <a href="Categorías.html">Regresar</a>
                    </button>
                </td>
            </tr>
        </table>
    </div>


    <div id="Subtitulo">
    <span>
        Bienvenido a la categoría de burós!!
    </span>
    <hr>
    </div>
    <table id="ContentAll">
        <tr>
            <?php $productCount = 0; ?>
            <?php foreach ($products as $product) : ?>
                <td class="Art">
                    <section class="Producto">
                        <article class="Contenido">
                            <label id="TitleModalProducto">Nombre: <?php echo $product['name'];?> </label>
                            <hr>
                            <br>
                            <img src="../Img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="card-img-top">
                            <br>
                            <!-- <div class="Decripcion">Cómoda elaborada con madera de pino de 3 cajones estilo rústico liso.</div> -->
                            <br>
                            <div id="PriceModal"><?php echo '$',$product['price'];?></div>
                            <form action="Buros.php" method="post">
                                <input type="hidden" name="action" value="add_to_cart">
                                <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                                <label class="Cant">Cantidad: </label>
                                <input type="number" name="quantity" value="1" min="1" class="Cant" id="InputCant">
                                <br><br>
                                <button type="submit" name="add_to_cart" id="Add" class="Agregar"> <i class="fa-solid fa-cart-plus fa-flip-horizontal"></i>Agregar al carrito</button>
                                <button class="Log"><i class="fa-solid fa-user-check"></i> <a href="Inicio de sesion.php">Registrese o inicie sesión para comprar...</a></button>
                                <br id="Br">
                                <button type="button" onclick="openCustomModal('<?php echo $product['name']; ?>')" id="BtnVerMás">Detalles</button>

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
            <?php endforeach; ?>
        </tr>
    </table>
    <?php foreach ($products as $product) : ?>
    <!-- Modal dinámico para cada producto -->
    <div class="custom-modal" id="myModal<?php echo $product['name']; ?>">
    <div>
        <div class="modal-overlay" onclick="closeCustomModal('<?php echo $product['name']; ?>')"></div>
    </div>
        <div class="modal-content">
            <div class="ModalHead">
                <span id="CloseModalDn" onclick="closeCustomModal('<?php echo $product['name']; ?>')">&times;</span>
            </div>
            <h5 class="modal-title">Detalles del producto - <?php echo $product['name']; ?></h5>
            <div class="modal-body">
                <label class="TituloArt" style="font-weight: 400;">Precio: $<?php echo $product['price']; ?></label>
                <hr style="font-weight: 900; color: black; width: 85%;">
                <label class="CategoriaArt" style="font-weight: 500;">Categoria: <?php echo $product['category']; ?></label>
                <hr style="font-weight: 900; color: black; width: 90%;">
                <label class="TituloArt" style="font-weight: 400;">Material: <?php echo $product['material']; ?></label>            
                <hr style="font-weight: 900; color: black; width: 90%;">
                <label class="Medidas" style="font-weight: 600;">Medidas: Alto - <?php echo $product['alto']; ?> | Fondo - <?php echo $product['fondo']; ?> | Largo - <?php echo $product['largo']; ?></label>
                </div>
            <div class="modal-footer">
                <button type="button" class="BtnClose" onclick="closeCustomModal('<?php echo $product['name']; ?>')"><i class="fa-solid fa-xmark"></i>Cerrar</button>
            </div>
        </div>
    </div>
    <!--Fin del modal dinámico para detalles del producto-->
<?php endforeach; ?>
    <footer class="footer">
        <p>Domicilio: Zapopan | N.1231 | Col: El Rosal</p>
    </footer>

    <script>

function openCustomModal(name) {
        document.getElementById('myModal' + name).style.display = 'block';
    }

    function closeCustomModal(name) {
        document.getElementById('myModal' + name).style.display = 'none';
    }

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
