<?php
session_start();
// foreach ($_SESSION['productNames'] as $product) {
//    // echo $product->name . " (" . $product->price . ")---".$product -> quantity; //Se extrae el sub indice quantity del arreglo original.
// }
// echo '<br>';
// echo $_SESSION['Cant'];
// $_SESSION['productNames'] = json_decode($productNamesJSON); //JSON que trae el contenido del arreglo del nombre de los productos

// echo $_SESSION['IdUser'];

require('./fpdf.php');

class PDF extends FPDF
{
   // protected $favicon;

   // // Constructor
   // function __construct($favicon)
   // {
   //    parent::__construct();
   //    $this->favicon = $favicon;
   // }
   // Cabecera de página
   function Header()
   {
      // if ($this->favicon !== null && file_exists($this->favicon)) {
      //    $this->Image($this->favicon, 10, 10, 10); // Ajusta las coordenadas y el tamaño según tu diseño
      // }
      //include '../../recursos/Recurso_conexion_bd.php';//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('Logo_Carp.png', 175, 7, 30); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('CVM-M'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color   
      /* DATos INICiO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("DATOS DEL CLIENTE"), 0, 0, '', 0);
      $this->Ln(5);
      // DATOS
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', '', 10);
      $this->Cell(96, 10, utf8_decode("Cliente: ".$_SESSION['User']), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', '', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono: ".$_SESSION['Number']), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', '', 10);
      $this->Cell(85, 10, utf8_decode("Dirección: ".$_SESSION['Dir']), 0, 0, '', 0);
      $this->Ln(9);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor( 0, 6, 37);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("Ficha de pago de productos "), 0, 1, 'C', 0);
      $this->Ln(5);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(0, 123, 188 ); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(146, 148, 149); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      // $this->Cell(45, 10, utf8_decode('Id'), 1, 0, 'C', 1);
      $this->Cell(90, 10, utf8_decode('Productos'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Cantidad'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Subtotal'), 1, 1, 'C', 1);
      // $this->Cell(90, 10, utf8_decode('Subtotal'), 1, 1, 'C', 1);
      // $this->Cell(55, 10, utf8_decode('Total a pagar'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}
// $pdf = new PDF('favicon.png');
$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 8);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$i = $i + 1;
/* TABLA */
$productNames = $_SESSION['productNames'];

// Recorrer el arreglo y mostrar los datos en el PDF
foreach ($productNames as $product) {
    $productName = $product->name;
   //  $productSubtotal = $product->price;
    $productQuantity = $product->quantity;
    $subtotal = $product->quantity * $product->price;
   //  $productTotal = $product->total;
   $Cant = $_SESSION['Cant'];
    $pdf->Cell(90, 10, utf8_decode($productName), 1, 0, 'C');
    $pdf->Cell(40, 10, utf8_decode($productQuantity), 1, 0, 'C');
    $pdf->Cell(40, 10, utf8_decode('$'.number_format($subtotal,2)), 1, 1, 'C');
   //  $pdf->Cell(90, 10, utf8_decode("Total"), 1, 1, 'C', 1);
   //  $pdf->Cell(55, 10, utf8_decode($Cant), 1, 1, 'C');
    
}
$pdf->Cell(30, 10, 'IVA:', 1, 0, 'C');
// $pdf->Cell(55, 10, '', 1, 0, 'C'); // Celda vacía para mantener el formato
$pdf->SetFillColor(  238, 241, 255  ); // Amarillo

$pdf->Cell(55, 10, utf8_decode('$' . number_format($_SESSION['IVA'], 2)), 1, 1, 'C',true); // Muestra el total con formato
$pdf->Cell(30, 10, 'Total:', 1, 0, 'C');
// $pdf->Cell(55, 10, '', 1, 0, 'C'); // Celda vacía para mantener el formato
$pdf->SetFillColor(  238, 241, 255  ); // Amarillo

$pdf->Cell(55, 10, utf8_decode('$' . number_format($_SESSION['Cant'], 2)), 1, 1, 'C',true); // Muestra el total con formato
$pdf->Output('Formato de pago', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
?>
