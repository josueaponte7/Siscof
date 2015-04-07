<?php

define('BASEPATH', '');
require_once '../../modelo/mantenimientos/UsuarioF.php';
require_once '../../modelo/mantenimientos/Departamento.php';

$objmod = new UsuarioF();

require_once './tcpdf/spa.php';
require_once './tcpdf/MyClass.php';
//$obj  = new Conexion();


//$total         = $obj->totalFilas('herramientas', 'id_herramientas', $campos['condicion']);

$pdf = new MyClass("P", "mm", "A4", true, 'UTF-8', false);

// Mostrar Cabecera de titulo en las hojas
$pdf->setPrintHeader(true);
// salto de linea
$pdf->Ln(50);
// Mostrar Cabecera de footer en las hoja
$pdf->setPrintFooter(true);
// mostrar numero de paginas
$pdf->SetAutoPageBreak(true);
//setear margenes 
$pdf->SetMargins(15, 20, 15);
// añadimos la pagina
$pdf->AddPage();
$pdf->Ln(15);

/* * ******Imagen del logo en la primera hoja********* */
//$pdf->Image('imagenes/logo.png', 3, 18, 45, 15, 'PNG', FALSE);


// titulo del listado
$titulo = "LISTADO DE USUARIOS";
$pdf->Ln(5);
$pdf->SetX(60);
// fuente y tamaño de letra 
$pdf->SetFont('FreeSerif', 'B', 14);
// añadimos el titulo
$pdf->Cell(90, 0, $titulo, 0, 0, 'C', 0);
$pdf->Ln(15);

/* * ********************************** */



$j            = 0;
// Cantidad maxima de registros a mostrar por pagina
$max          = 35;
$row_height   = 6;
$backup_group = "";


// width de las filas 

$w_usuario      = 30;
$w_nombres      = 40;
$w_tipo         = 20;
$w_departamento = 40;
$w_estatus      = 25;
// Mover a la derecha 
$pdf->SetX(18);
$pdf->SetFillColor(39, 129, 213);
$pdf->SetFont('FreeSerif', 'B', 11);

// Titulos de la Cabecera
$pdf->Cell($w_usuario, $row_height, 'Usuario', 1, 0, 'C', 1);
$pdf->Cell($w_nombres, $row_height, 'Nombres', 1, 0, 'C', 1);
$pdf->Cell($w_tipo, $row_height, 'Tipo', 1, 0, 'C', 1);
$pdf->Cell($w_departamento, $row_height, 'Departamento', 1, 0, 'C', 1);
$pdf->Cell($w_estatus, $row_height, 'Estatus', 1, 1, 'C', 1);
$resultado = $objmod->getUsuarioF();

$total = count($resultado);
// Ciclo para crear los registros
for ($i = 0; $i < count($resultado); $i++) {

    // Asignarle variables a los registros
    $usuario     = $resultado[$i]['usuario'];
    $nombres     = $resultado[$i]['nombre'] . ' ' . $resultado[$i]['apellido'];
    $perfil      = $resultado[$i]['perfil'];
    $deparamento = $resultado[$i]['nombre_departamento'];

    // verificar que la variable $j no si es mayor se hace un salto de pagina
    if ($j > $max) {
        $pdf->AddPage();

        // color de la letra
        $pdf->SetFillColor(255, 255, 255);

        // salto de linea
        $pdf->Ln(15);
        /*         * ****Imagen del logo de las hojas que continua***** */
        $pdf->Image('imagenes/logo.png', 3, 18, 45, 15, 'PNG', FALSE);
        // Tipo de letra negrita tamaño 14
        $pdf->SetFont('FreeSerif', 'B', 11);

        $pdf->SetX(60);
        // Titulo del Reporte width:90 heigth:0 text:$titulo alineacion:C
        $pdf->Cell(90, 0, $titulo, 0, 0, 'C', 0);
        $pdf->Ln(15);

        // Color Cabecera de la tabla
        $pdf->SetFillColor(39, 129, 213);
        $pdf->SetX(10);
        $pdf->Cell($w_usuario, $row_height, 'Usuario', 1, 0, 'C', 1);
        $pdf->Cell($w_nombres, $row_height, 'Nombres', 1, 0, 'C', 1);
        $pdf->Cell($w_tipo, $row_height, 'Tipo', 1, 0, 'C', 1);
        $pdf->Cell($w_departamento, $row_height, 'Departamento', 1, 0, 'C', 1);
        $pdf->Cell($w_estatus, $row_height, 'Estatus', 1, 1, 'C', 1);
        $j = 0;
    }

$w_usuario      = 30;
$w_nombres      = 40;
$w_tipo         = 20;
$w_departamento = 40;
$w_estatus      = 25;
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('FreeSerif', '', 10);
    if ($i % 2 != 0) {
        $pdf->SetFillColor(204, 205, 206);
    }

    /* $pdf->SetTextColor(0, 0, 0);
      if ($id == 20 || $id == 40 || $id == 60) {
      $pdf->SetTextColor(255, 0, 0);
      } */
    $usuario     = $resultado[$i]['usuario'];
    $nombres     = $resultado[$i]['nombre'] . ' ' . $resultado[$i]['apellido'];
    $perfil      = $resultado[$i]['perfil'];
    $deparamento = $resultado[$i]['nombre_departamento'];
    $estatus = 'Activo';
    if ($resultado[$i]['activo'] == 0) {
        $estatus = 'Inactivo';
    }
    // crear los registros a mostrar
    $pdf->SetFont('FreeSerif', '', 10);
    $pdf->SetX(18);
    $pdf->Cell($w_usuario, $row_height, $usuario, 1, 0, 'C', 1);
    $pdf->Cell($w_nombres, $row_height, $nombres, 1, 0, 'C', 1);
    $pdf->Cell($w_tipo, $row_height, $perfil, 1, 0, 'C', 1);
    $pdf->Cell($w_departamento, $row_height, $deparamento, 1, 0, 'C', 1);
    $pdf->Cell($w_estatus, $row_height, $estatus, 1, 1, 'C', 1);
    $j++;
}
/* * *************Linea de fin de hoja con la cantidad total de registros********************* */
$pdf->setCellMargins(0, 0, 0, 0);
$linea     = '-------------------------------------------------------------------------------------------------------------------------------------';
$pdf->Ln();
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(0, 0, $linea, 0, 0, 'L', 1);
$pdf->Ln(6);
//$pdf->Write(14, 'Registros:' . '' . $h);
$pdf->SetFont('FreeSerif', '', 10);
$pdf->SetFont('FreeSerif', '', 10);
$registros = 'Total de Registros:<span style="color:#FF0000;">' . $total . '</span>';
$pdf->writeHTMLCell(50, 6, 125,'', $registros, 0, 0, false, true, 'R', true);
$pdf->Output('listado_herramientas.pdf', 'I');


