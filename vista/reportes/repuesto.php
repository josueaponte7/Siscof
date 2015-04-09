<?php

define('BASEPATH', '');
require_once '../../modelo/inventario/Repuesto.php';
require_once './tcpdf/spa.php';
require_once './tcpdf/MyClass.php';
//$obj  = new Conexion();

$campos['condicion'] = 1 . ' AND condicion=1';
$id_repuesto_condicion    = 'id_repuesto';
if (isset($_GET['id_repuesto'])) {

    $id                  = $_GET['id_repuesto'];
    $campos['condicion'] = " $id_repuesto_condicion IN($id)";
}

$obj           = new Repuesto();
$sql = "SELECT 
        i.id_items,
        i.nombre,
        r.marca_repuesto,
        r.modelo_repuesto,
        r.id_repuesto
      FROM
        repuesto AS r
        INNER JOIN items_inventario AS i ON r.id_items = i.id_items ";
$resultado = $obj->ex_query($sql);
//$total         = $obj->totalFilas('repuestos', 'id_repuesto', $campos['condicion']);

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
$titulo = "LISTADO DE COMPONENTES";
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

$w_nombre    = 60;
$w_marca   = 60;
$w_modelo = 60;


// Mover a la derecha 
$pdf->SetX(18);

// Color Cabecera de la tabla
$pdf->SetFillColor(39, 129, 213);

// Titulos de la Cabecera
$pdf->SetFont('FreeSerif', 'B', 11);
$pdf->Cell($w_nombre, $row_height, 'Nombre Repuesto', 1, 0, 'C', 1);
$pdf->Cell($w_marca, $row_height, 'Marca', 1, 0, 'C', 1);
$pdf->Cell($w_modelo, $row_height, 'Modelo', 1, 1, 'C', 1);

$total = count($resultado);
// Ciclo para crear los registros
for ($i = 0; $i < count($resultado); $i++) {

    // Asignarle variables a los registros
    $nombre_repuesto   = $resultado[$i]['nombre'];
    $marca_repuesto = $resultado[$i]['marca_repuesto'];
    $modelo_repuesto = $resultado[$i]['modelo_repuesto'];

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
        $pdf->SetFont('FreeSerif', 'B', 11);

        $pdf->SetX(60);
        // Titulo del Reporte width:90 heigth:0 text:$titulo alineacion:C
        $pdf->Cell(90, 0, $titulo, 0, 0, 'C', 0);
        $pdf->Ln(15);

        // Color Cabecera de la tabla
        $pdf->SetFillColor(39, 129, 213);
        $pdf->SetX(10);
        $pdf->Cell($w_nombre, $row_height, 'Nombre Componente', 1, 0, 'C', 1);
        $pdf->Cell($w_marca, $row_height, 'Marca', 1, 0, 'C', 1);
        $pdf->Cell($w_modelo, $row_height, 'Modelo', 1, 1, 'C', 1);
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
    $pdf->SetFont('FreeSerif', '', 10);
    $pdf->SetX(18);
    $pdf->Cell($w_nombre, $row_height, $nombre_repuesto, 1, 0, 'C', 1);
    $pdf->Cell($w_marca, $row_height, $marca_repuesto, 1, 0, 'C', 1);
    $pdf->Cell($w_modelo, $row_height, $modelo_repuesto, 1, 1, 'C', 1);
    $j++;
}
/* * *************Linea de fin de hoja con la cantidad total de registros********************* */
$pdf->setCellMargins(0, 0, 0, 0);
$linea     = '---------------------------------------------------------------------------------------------------------------------------------------------------------';
$pdf->Ln();
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(0, 0, $linea, 0, 0, 'L', 1);
$pdf->Ln(6);
//$pdf->Write(14, 'Registros:' . '' . $h);
$pdf->SetFont('FreeSerif', '', 10);
$registros = 'Total de Registros:<span style="color:#FF0000;">' . $total . '</span>';
$pdf->writeHTML($registros, true, false, true, false, 'R');
$pdf->Output('listado_repuestos.pdf', 'I');


