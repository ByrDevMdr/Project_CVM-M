<?php
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
if (!$Conexion) {
    die("La conexión falló: " . mysqli_connect_error());
}

$Consulta = "Select distinct Categoria from Articulos";
$result = mysqli_query($Conexion, $Consulta);

if ($result) {
    $Categoria = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $Categoria[] = $row['Categoria'];
    }
    mysqli_free_result($result);
} else {
    echo "Error en la consulta: " . mysqli_error($Conexion);
}

mysqli_close($Conexion);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar producto</title>
    <!-- Link de jquery para relaizar peticiones de javascript asincronas con AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!--Cambiar el icono de la página en la pestaña superior de búsqueda-->
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--Enlace para la hoja de estilos-->
    <link rel="stylesheet" href="StyleAddProd.css">
     <!--Iconos de fontawesome-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!--Enlace para la tiografía -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Capriola&display=swap" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Afacad&display=swap" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Modal de confirmación de que el producto se ha agregado correctamente -->
<div id="Modal">
    <section id="ModalBack">
        <article id="ModalContent">
            <span id="MessageCorrect">
                Mensaje sobre el producto
            </span>
            <div id="ModalBody">
            <span id="ContentModalBoy">
                <i class="fa-regular fa-circle-check" id="Correct"></i>
                <hr>
                <br>
                <span id="MessageModalBody">
                    El producto se ha registrado correctamente!!
                </span>
            </span>
        </div>
        </article>
    </section>
</div>
    <!-- Fin del modal de confirmación de pedido -->
    <table class="head" id="Head">
        <tr>
            <td class="head" id="Logo">
                <img src="../Img/Logo.png" alt="Logo_Carp">
            </td>
            <td class="head" id="ContentTitulo">
                <span id="Titulo">Sesión privilegiada: añadir producto</span>
            </td>
            <td class="head" id="ContentBtn">
                <button id="Regresar">
                    <i class="fa-solid fa-arrow-left"></i>
                    <a href="GestionProd.php">Volver</a>
                </button>
            </td>

        </tr>
    </table>

    <section id="ContentPrimary">
        <div id="ContentTitle"><span id="TittleBody">Registro de nuevo producto</span></div>
        <article id="ContentForm">
            <form action="AddProdu.php" method="post" id="Form" enctype="multipart/form-data">
                <label for="NameProd" class="TitleReq">Nombre del producto: </label>
                <input type="text" name="Nombre" id="NameProd" class="BreakRow">
                <br>
                <label for="Category" class="TitleReq">Categoría: </label>
                <select name="Categoria" id="Category" class="BreakRow">
                <option value="" selected disabled class="OptionRol">Seleccione una categoría</option>
                    <?php foreach ($Categoria as $category) : ?>
                        <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <label for="Alto" class="TitleReq">Alto: </label>
                <input type="text" name="Alto" id="Alto" class="BreakRow">
                <br>
                <label for="Largo" class="TitleReq">Largo: </label>
                <input type="text" name="Largo" id="Largo" class="BreakRow">
                <br>
                <label for="Fondo" class="TitleReq">Fondo: </label>
                <input type="text" name="Fondo" id="Fondo" class="BreakRow">
                <br>
                <label for="Material" class="TitleReq">Material: </label>
                <input type="text" name="Material" id="Material" class="BreakRow">
                <br>
                <label for="Precio" class="TitleReq">Precio: </label>
                <input type="text" name="Precio" id="Precio" class="BreakRow">
                <br>
                <label for="Imagen" class="TitleReq">Imagen: </label>
                <input type="file" name="Imagen" id="Imagen" accept="image/*" class="BreakRow" >
                <br>
                <section id="ContentBtnForm">
                    <button type="submit" class="BtnForm" id="BtnA"><i class="fa-regular fa-circle-check"></i> Aceptar</button>    
                    <button type="reset" class="BtnForm" id="BtnB"><i class="fa-solid fa-rotate-left"></i> Reiniciar</button>
                </section>
            </form>
        </article>
    </section>
    <script>
    $(document).ready(function() {
        $("#Form").submit(function(event) {
            event.preventDefault(); // Evitar el envío tradicional del formulario

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
                        DeletInput();
                        location.reload(); //Se recarga la página
                    }, 1000);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
    // Función para eliminar el contenido de los inputs de información para agregar producto.
        function DeletInput() {
    var inputs = document.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = "";
    }
    document.getElementById("Category").value="";
}
</script>
</body>
</html>