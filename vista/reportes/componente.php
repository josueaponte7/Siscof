<?php

define('BASEPATH', '');
require_once '../../modelo/inventario/Componente.php';
require_once './tcpdf/spa.php';
require_once './tcpdf/MyClass.php';
//$obj  = new Conexion();

$campos['condicion'] = 1 . ' AND condicion=1';
$id_componente_condicion    = 'id_componente';
if (isset($_GET['id_componente'])) {

    $id                  = $_GET['id_herramientas'];
    $campos['condicion'] = " $id_componente_condicion IN($id)";
}

$obj           = new Componente();
$sql = "SELECT 
                    i.id_items,
                    i.nombre,
                    c.marca_componente,
                    c.serial_componente,
                    c.num_bien_componente,
                    c.id_componente
                   FROM componente AS c
                   INNER JOIN items_inventario AS i ON c.id_items=i.id_items;";
$resultado = $obj->ex_query($sql);
//$total         = $obj->totalFilas('componente', 'id_componente', $campos['condicion']);

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

$w_nombre   = 45;
$w_marca    = 45;
$w_serial   = 45;
$w_num_bien = 45;

// Mover a la derecha 
$pdf->SetX(18);

// Color Cabecera de la tabla
$pdf->SetFillColor(39, 129, 213);
$pdf->SetFont('FreeSerif', 'B', 11);
// Titulos de la Cabecera
$pdf->Cell($w_nombre, $row_height, 'Nombre Componente', 1, 0, 'C', 1);
$pdf->Cell($w_marca, $row_height, 'Marca Componente', 1, 0, 'C', 1);
$pdf->Cell($w_serial, $row_height, 'Serial Componente', 1, 0, 'C', 1);
$pdf->Cell($w_num_bien, $row_height, 'Numero de Bien', 1, 1, 'C', 1);

$total = count($resultado);
// Ciclo para crear los registros
for ($i = 0; $i < count($resultado); $i++) {

    // Asignarle variables a los registros
    

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
        $pdf->Cell($w_nombre, $row_height, 'Nombre Componente', 1, 0, 'C', 1);
        $pdf->Cell($w_marca, $row_height, 'Marca Componente', 1, 0, 'C', 1);
        $pdf->Cell($w_serial, $row_height, 'Serial Componente', 1, 0, 'C', 1);
        $pdf->Cell($w_num_bien, $row_height, 'Numero de Bien', 1, 1, 'C', 1);
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

    $nombre_componente   = $resultado[$i]['nombre'];
    $marca_componente    = $resultado[$i]['marca_componente'];
    $serial_componente   = $resultado[$i]['serial_componente'];
    $num_bien_componente = $resultado[$i]['num_bien_componente'];
    // crear los registros a mostrar
    $pdf->SetFont('FreeSerif', '', 10);
    $pdf->SetX(18);
    $pdf->Cell($w_nombre, $row_height, $nombre_componente, 1, 0, 'C', 1);
    $pdf->Cell($w_marca, $row_height, $marca_componente, 1, 0, 'C', 1);
    $pdf->Cell($w_serial, $row_height, $serial_componente, 1, 0, 'C', 1);
    $pdf->Cell($w_num_bien, $row_height, $num_bien_componente, 1, 1, 'C', 1);
    $j++;
}
/* * *************Linea de fin de hoja con la cantidad total de registros********************* */
$pdf->setCellMargins(0, 0, 0, 0);
$linea     = '-----------------------------------------------------------------------------------------------------------------------------------------------------------';
$pdf->Ln();
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(250, 0, $linea, 0, 0, 'L', 1);
$pdf->Ln(6);
//$pdf->Write(14, 'Registros:' . '' . $h);
$pdf->SetFont('FreeSerif', '', 10);
$registros = 'Total de Registros:<span style="color:#FF0000;">' . $total . '</span>';
$pdf->writeHTML($registros, true, false, true, false, 'R');
$pdf->Output('listado_componentes.pdf', 'I');


