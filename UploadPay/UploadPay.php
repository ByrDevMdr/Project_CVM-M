<!DOCTYPE html>
<html lang="en">
<head>
    <!--Librería de estilos de Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Link de estilos-->
    <link rel="stylesheet" href="../Pages/StyleUploadPay2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir comprobante de pago</title>
</head>
<body>
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
                            La imagen se ha subido correctamente!!
                        </span>
                    </span>
                </div>
                </article>
            </section>
        </div>
<table id="Encabezado" style="width:100%;">
        <tr>
          <td class="Content" id="ContentLogo">
            <img src="../Img/Logo.png" alt="LogoCarp">
          </td>
          <td class="Content" id="ContentTitulo">
            <span id="Titulo" style="text-align: start; ">Evidencia de pago</span>
          </td>
          <td class="Content" id="ContentBtn">
        <button id="Regresar">
                <i class="fa-solid fa-caret-left"></i>
                <a href="../index.php">Volver</a>
            </button>
          </td>
        </tr>
      </table>
        <div id="Container">
            <section id="ContentPart1">
                <article id="Steps1">
                    <span class="TypeStep">Estos pasos son en caso de que tenga en comprobante de pago físicamente.</span>
                    <hr>
                    <br>
                    <div class="ContentStep">
                        <span class="TitleStep">
                            1. Comprobante de pago:
                            <p class="DescStep">Una vez que haya ído a pagar, tome el comprobante de pago que se otorgó donde viene la información de la operación.</p>
                        </span>
                        <img src="ImgInstruction/1-Paso.PNG" alt="Paso 1" class="ImageStep">
                    </div>
                    <div class="ContentStep">
                        <span class="TitleStep">
                            2. Imagen de comprobante:
                            <p class="DescStep">Coloque su comprobante en una zona iluminada y de preferenceia en una superficie solida para proceder con su teléfono móvil, tomar una foto.</p>
                        </span>
                        <img src="ImgInstruction/2-Paso.PNG" alt="Paso 2" class="ImageStep">
                    </div>
                    <div class="ContentStep">
                        <span class="TitleStep">
                            3. Subir foto del comprobante:
                            <p class="DescStep">Dirigirse al menú correspondiente en la página para poder subir el archivo.</p>
                        </span>
                        <img src="ImgInstruction/3-Paso.PNG" alt="Paso 3" class="ImageStep">
                        <img src="ImgInstruction/3.1-Paso.PNG" alt="Paso 3" class="ImageStep3_1">
                    </div>
                </article>
            </section>
            <section id="ContentPart2">
                <article id="Steps2">
                <span class="TypeStep">Estos pasos son en caso de que tenga en comprobante de pago de forma digital.</span>
                <hr>
                <br>    
                <div class="ContentStep">
                        <span class="TitleStep">
                            1. Comprobante de pago digital:
                            <p class="DescStep">Una vez que haya realizado la tranferencia de forma digital, tome una captura o guarde el documento que generó el servicio utilizado.</p>
                        </span>
                        <img src="ImgInstruction/1.1-Paso.PNG" alt="Paso 1.1" class="ImageStep">
                    </div>
                    <div class="ContentStep">
                        <span class="TitleStep">
                            2. Subir foto del documento generado:
                            <p class="DescStep">Dirigirse al menú correspondiente en la página para poder subir el archivo.</p>
                        </span>
                        <img src="ImgInstruction/3-Paso.PNG" alt="Paso 3" class="ImageStep">
                        <img src="ImgInstruction/3.1-Paso.PNG" alt="Paso 3" class="ImageStep3_1">
                    </div>
                </article>
            </section>
        </div>
      <section id="ContentForm">
        <form id="uploadForm" enctype="multipart/form-data">
            <label for="imageUpload" id="LblType">Subir Comprobante (PDF, JPG, PNG):</label>
            <input type="file" name="comprobante" id="imageUpload" accept=".pdf, .jpg, .jpeg, .png" required>
            <button type="submit" id="BtnUpload"><i class="fa-solid fa-upload"></i> Subir Imagen</button>
        </form>
        <div id="uploadStatus"></div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#uploadForm').on('submit', function(event) {
                event.preventDefault(); // Prevenir que el formulario se envíe normalmente

                var formData = new FormData(this);

                $.ajax({
                    url: 'Upload.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        showSuccessModal();
                    },
                    error: function() {
                        $('#uploadStatus').html('<p style="color:red;">Hubo un error al subir tu archivo.</p>');
                    }
                });
            });
        });
        function showSuccessModal() {
        var modal = document.getElementById('Modal');
        modal.style.display = 'block';

        // Cierra el modal después de 2 segundos y redirige
        setTimeout(function() {
        modal.style.display = 'none';
        window.location.href = '../index.php';
        //   window.location.href = 'Capture.php';
        }, 2000);
  }
    </script>
</body>
</html>