<?php
session_start();
if(!$Reportes=simplexml_load_file('../XML/Reporte.xml')){
   echo 'No se cargo el archivo';
}else{
   foreach($Reportes as $Reporte){
       $Id = $Reporte -> Id;
       $Nombre = $Reporte -> Nombre;
       $Pedidos = $Reporte -> Pedidos;
       $Ganancias = $Reporte -> Ganancias;
       $_SESSION['Direccion'] = $Reporte -> Direccion;
       $_SESSION['Telefono'] = $Reporte -> Telefono;
       $_SESSION['Correo'] = $Reporte -> Correo;
   }
}

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
      /* UBICACION */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Direccion: ".$_SESSION['Direccion']), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono: ".$_SESSION['Telefono']), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo: ".$_SESSION['Correo']), 0, 0, '', 0);
      $this->Ln(9);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(221, 100, 0);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("Reporte de trabajo semanal "), 0, 1, 'C', 0);
      $this->Ln(5);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 80, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(45, 10, utf8_decode('Id'), 1, 0, 'C', 1);
      $this->Cell(45, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
      $this->Cell(45, 10, utf8_decode('Pedidos terminados'), 1, 0, 'C', 1);
      $this->Cell(45, 10, utf8_decode('Ganancias (Aprox)'), 1, 1, 'C', 1);
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
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$i = $i + 1;
/* TABLA */
$pdf->Cell(45, 10, utf8_decode($Id), 1, 0, 'C', 0);
$pdf->Cell(45, 10, utf8_decode($Nombre), 1, 0, 'C', 0);
$pdf->Cell(45, 10, utf8_decode($Pedidos), 1, 0, 'C', 0);
$pdf->Cell(45, 10, utf8_decode($Ganancias), 1, 1, 'C', 0);

$pdf->Output('Reporte.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
?>
