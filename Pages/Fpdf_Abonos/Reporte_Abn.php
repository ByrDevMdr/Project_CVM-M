<?php
session_start();
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$consulta = "Select Abonos.*, Clientes.Nombre AS NombreCliente, Clientes.Apellido as ApellidoCliente, Pedidos.Estado AS EstadoPedido from Abonos join Clientes on  Abonos.Id_Cliente = Clientes.Id_Cliente join Pedidos ON Abonos.Id_Pedido = Pedidos.Id_Pedido";
#Con consultas y un JOIN, se puede unir una tabla con otra teniendo un valor como referencia (Las llaves foraneas).
$resultado = mysqli_query($Conexion, $consulta);

if ($resultado->num_rows > 0) {
    $Abono = [];

    while ($row = $resultado->fetch_assoc()) {
        $Abono[] = [
            'id' => $row['Id_Abono'],
            'idC' => $row['Id_Cliente'],
            'orderId' => $row['Id_Pedido'],
            'date' => $row['Fecha'],
            'amount' => $row['Cantidad'],
            'clientName' => $row['NombreCliente'],
            'clientSurname' => $row['ApellidoCliente'],
            'orderState' => $row['EstadoPedido'],
        ];
    }
}
require('./fpdf_Abn.php');

class PDF extends FPDF
{
   function Header()
   {
      $this->Image('Logo_Carp.png', 175, 7, 30); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19);
      $this->Cell(45);
      $this->SetTextColor(0, 0, 0);
      $this->Cell(110, 15, utf8_decode('CVM-M'), 1, 1, 'C', 0);
      $this->Ln(3);
      $this->SetTextColor(103);
      $this->Cell(110);
      // $this->SetFont('Arial', 'B', 10);
      // $this->Cell(96, 10, utf8_decode("Direccion: ".$_SESSION['Direccion']), 0, 0, '', 0);
      // $this->Ln(5);
      // $this->Cell(110);
      // $this->SetFont('Arial', 'B', 10);
      // $this->Cell(59, 10, utf8_decode("Teléfono: ".$_SESSION['Telefono']), 0, 0, '', 0);
      // $this->Ln(5);
      // $this->Cell(110);
      // $this->SetFont('Arial', 'B', 10);
      // $this->Cell(85, 10, utf8_decode("Correo: ".$_SESSION['Correo']), 0, 0, '', 0);
      $this->Ln(9);
      $this->SetTextColor(221, 100, 0);
      $this->Cell(50);
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("Reporte de abonos "), 0, 1, 'C', 0);
      $this->Ln(5);
      $this->SetFillColor(228, 80, 0);
      $this->SetTextColor(255, 255, 255);
      $this->SetDrawColor(163, 163, 163);
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(30, 10, utf8_decode('N# abono'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Cliente'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Cantidad'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Pedido'), 1, 1, 'C', 1);
   }

   function Footer()
   {
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C');
   }
}

$pdf = new PDF();
$pdf->AddPage();

foreach ($Abono as $Abonos) {
    $pedidoId = $Abonos['orderId'];
    $consultaDetallesPedido = "Select * from Pedidos where Id_Pedido = $pedidoId";
    $resultadoDetallesPedido = mysqli_query($Conexion, $consultaDetallesPedido);
    $detallesPedido = mysqli_fetch_assoc($resultadoDetallesPedido);

    $pdf->Cell(30, 10, utf8_decode($Abonos['id']), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($Abonos['clientName']), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($Abonos['date']), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode('$'.$Abonos['amount']), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($detallesPedido['Id_Pedido']), 1, 1, 'C', 0); 
}

$pdf->Output();
?>
