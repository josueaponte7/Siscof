<?php

define('BASEPATH', '');
require_once '../../modelo/inventario/Equipos.php';
require_once './tcpdf/spa.php';
require_once './tcpdf/MyClass.php';
//$obj  = new Conexion();

$campos['condicion'] = 1 . ' AND condicion=1';
$id_equipos_condicion    = 'id_equipos';
if (isset($_GET['id_equipos'])) {

    $id                  = $_GET['id_equipos'];
    $campos['condicion'] = " $id_equipos_condicion IN($id)";
}

$obj           = new Equipos();
$campos['sql'] = "SELECT
                    cod_equipo,
                    marca,
                    modelo,
                    serial_equipo
                  FROM equipos
                    WHERE " . $campos['condicion'] . "
                  ORDER BY id_equipos;";
$resultado     = $obj->getEquipos($campos);
//$total         = $obj->totalFilas('equipos', 'id_equipos', $campos['condicion']);

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
$titulo = "LISTADO DE EQUIPOS";
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

$w_cod    = 40;
$w_marca   = 50;
$w_modelo   = 50;
$w_serial   = 40;


// Mover a la derecha 
$pdf->SetX(16);

// Color Cabecera de la tabla
$pdf->SetFillColor(39, 129, 213);

// Titulos de la Cabecera
$pdf->Cell($w_cod, $row_height, 'Cod Equipo', 1, 0, 'C', 1);
$pdf->Cell($w_marca, $row_height, 'Marca', 1, 0, 'C', 1);
$pdf->Cell($w_modelo, $row_height, 'Modelo', 1, 0, 'C', 1);
$pdf->Cell($w_serial, $row_height, 'Serial Equipo', 1, 1, 'C', 1);

$total = count($resultado);
// Ciclo para crear los registros
for ($i = 0; $i < count($resultado); $i++) {

    // Asignarle variables a los registros
    $cod_equipo   = $resultado[$i]['cod_equipo'];
    $marca = $resultado[$i]['marca'];
    $modelo = $resultado[$i]['modelo'];
    $serial_equipo = $resultado[$i]['serial_equipo'];

    // verificar que la variable $j no si es mayor se hace un salto de pagina
    if ($j > $max) {
        $pdf->AddPage();

        // color de la letra
        $pdf->SetFillColor(255, 255, 255);

        // salto de linea
        $pdf->Ln(15);
        /*         * ****Imagen del logo de las hojas que continua***** */
        //$pdf->Image('imagenes/logo.png', 3, 18, 45, 15, 'PNG', FALSE);
        // Tipo de letra negrita tamaño 14
        $pdf->SetFont('FreeSerif', 'B', 14);

        $pdf->SetX(60);
        // Titulo del Reporte width:90 heigth:0 text:$titulo alineacion:C
        $pdf->Cell(90, 0, $titulo, 0, 0, 'C', 0);
        $pdf->Ln(15);

        // Color Cabecera de la tabla
        $pdf->SetFillColor(39, 129, 213);
        $pdf->SetX(10);
        $pdf->Cell($w_cod, $row_height, 'Cod Equipo', 1, 0, 'C', 1);
        $pdf->Cell($w_marca, $row_height, 'Marca', 1, 0, 'C', 1);
        $pdf->Cell($w_modelo, $row_height, 'Modelo', 1, 0, 'C', 1);
        $pdf->Cell($w_serial, $row_height, 'Serial Equipo', 1, 1, 'C', 1);
        $j = 0;
    }

    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('FreeSerif', '', 12);
    if ($i % 2 != 0) {
        $pdf->SetFillColor(204, 205, 206);
    }

    /* $pdf->SetTextColor(0, 0, 0);
      if ($id == 20 || $id == 40 || $id == 60) {
      $pdf->SetTextColor(255, 0, 0);
      } */

    // crear los registros a mostrar
    $pdf->SetFont('FreeSerif', '', 12);
    $pdf->SetX(16);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell($w_cod, $row_height, $cod_equipo, 1, 0, 'C', 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell($w_marca, $row_height, $marca, 1, 0, 'C', 1);
    $pdf->Cell($w_modelo, $row_height, $modelo, 1, 0, 'C', 1);
    $pdf->Cell($w_serial, $row_height, $serial_equipo, 1, 1, 'C', 1);
    $j++;
}
/* * *************Linea de fin de hoja con la cantidad total de registros********************* */
$pdf->setCellMargins(0, 0, 0, 0);
$linea     = '--------------------------------------------------------------------------------------------------------------------------------';
$pdf->Ln();
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(0, 0, $linea, 0, 0, 'L', 1);
$pdf->Ln(6);
$registros = 'Total de Registros:<span style="color:#FF0000;">' . $total . '</span>';
$pdf->SetFont('FreeSerif', '', 10);
$pdf->writeHTMLCell(50, 6, 145,'', $registros, 0, 0, false, true, 'R', true);;
$pdf->Output('listado_repuestos.pdf', 'I');


