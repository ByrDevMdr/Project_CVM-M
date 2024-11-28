<?php
$Id = $_POST['Id'];
$Nombre = $_POST['Nombre'];
$Pedidos = $_POST['Pedidos'];
$Ganancias = $_POST['Ganancias'];
$Direccion = $_POST['Direccion_P'];
$Telefono = $_POST['Telefono_P'];
$Correo = $_POST['Correo_P'];
$Fecha = $_POST['Date'];
#Carga del documento
    $Doc = new DOMDocument("1.0","utf-8"); # Generación del DOM como parámetros la versión y le codificación.
    $Doc -> formatOutput = true; # Formato legible para el XML.
    $Doc -> load("XML/Reporte.xml"); # Se carga el documento XML precviamente creado.
    #Obtener la raíz y eliminar todos sus hijos
    $Raiz = $Doc->getElementsByTagName("Reportes")->item(0);
    // while ($Raiz->hasChildNodes()) {
    // $Raiz->removeChild($Raiz->firstChild);
    // }
    #Generación de la rama padre.
    $Rama = $Doc -> createElement('Reporte');
    #Estructura principal de elementos
    $Hoja = $Doc -> createElement('Id');
    $Hoja -> appendChild($Doc -> createTextNode($Id));
    $Rama -> appendChild($Hoja);  # Se guara y se le concatena como 'hijo' a la rama padre que se inicializó: <Contacto>
    
    $Hoja = $Doc -> createElement('Fecha');
    $Hoja -> appendChild($Doc -> createTextNode($Fecha));
    $Rama -> appendChild($Hoja);  # Se guara y se le concatena como 'hijo' a la rama padre que se inicializó: <Contacto>

    $Hoja = $Doc -> createElement('Nombre');
    $Hoja -> appendChild($Doc -> createTextNode($Nombre));
    $Rama -> appendChild($Hoja);  # Se guara y se le concatena como 'hijo' a la rama padre que se inicializó: <Contacto>
    
    $Hoja = $Doc -> createElement('Pedidos');
    $Hoja -> appendChild($Doc -> createTextNode($Pedidos));
    $Rama -> appendChild($Hoja);  # Se guara y se le concatena como 'hijo' a la rama padre que se inicializó: <Contacto>
    
    $Hoja = $Doc -> createElement('Ganancias');
    $Hoja -> appendChild($Doc -> createTextNode('$'.$Ganancias));
    $Rama -> appendChild($Hoja);  # Se guara y se le concatena como 'hijo' a la rama padre que se inicializó: <Contacto>

    $Hoja = $Doc -> createElement('Direccion');
    $Hoja -> appendChild($Doc -> createTextNode($Direccion));
    $Rama -> appendChild($Hoja);  # Se guara y se le concatena como 'hijo' a la rama padre que se inicializó: <Contacto>

    $Hoja = $Doc -> createElement('Telefono');
    $Hoja -> appendChild($Doc -> createTextNode($Telefono));
    $Rama -> appendChild($Hoja);  # Se guara y se le concatena como 'hijo' a la rama padre que se inicializó: <Contacto>

    $Hoja = $Doc -> createElement('Correo');
    $Hoja -> appendChild($Doc -> createTextNode($Correo));
    $Rama -> appendChild($Hoja);  # Se guara y se le concatena como 'hijo' a la rama padre que se inicializó: <Contacto>
    
    $Raiz -> appendChild($Rama);  # Se guarda la rama en la raíz: <\Contacto>
    $Doc -> appendChild($Raiz); # Se guara la Raíz en el documento: <\Contactos>
    $Doc->save("XML/Reporte.xml"); #Se carga el archivo XML salvando los cambios que se hicieron.
?>