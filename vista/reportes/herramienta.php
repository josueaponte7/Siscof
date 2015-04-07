<?php

define('BASEPATH', '');
require_once '../../modelo/inventario/Herramientas.php';
require_once './tcpdf/spa.php';
require_once './tcpdf/MyClass.php';
//$obj  = new Conexion();

$campos['condicion'] = 1 . ' AND condicion=1';
$id_herramientas_condicion    = 'id_herramientas';
if (isset($_GET['id_herramientas'])) {

    $id                  = $_GET['id_herramientas'];
    $campos['condicion'] = " $id_herramientas_condicion IN($id)";
}

$obj           = new Herramientas();
$sql = "SELECT 
            ii.id_items,
            ii.nombre,
            h.marca_herramienta,
            h.serial_herramienta,
            h.num_bien_herramienta,
            h.id_herramientas,
            uf.nombre AS usuario,
            uf.apellido,
            uf.id_usuario_f 
        FROM
          herramientas AS h 
          INNER JOIN items_inventario AS ii ON h.id_items = ii.id_items 
          INNER JOIN usuario_f AS uf ON h.id_usuario_f = uf.id_usuario_f;";
$resultado = $obj->ex_query($sql);
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
$titulo = "LISTADO DE HERRAMIENTAS";
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

$w_nombrehe = 40;
$w_marcahe  = 50;
$w_serialhe = 50;
$w_usuario  = 30;

// Mover a la derecha 
$pdf->SetX(18);
$pdf->SetFont('FreeSerif', 'B', 10);
// Color Cabecera de la tabla
$pdf->SetFillColor(39, 129, 213);

// Titulos de la Cabecera
$pdf->Cell($w_nombrehe, $row_height, 'Nombre Herramienta', 1, 0, 'C', 1);
$pdf->Cell($w_marcahe, $row_height, 'Marca Herramienta', 1, 0, 'C', 1);
$pdf->Cell($w_serialhe, $row_height, 'Serial Herramienta', 1, 0, 'C', 1);
$pdf->Cell($w_usuario, $row_height, 'Usuario', 1, 1, 'C', 1);


// Ciclo para crear los registros
for ($i = 0; $i < count($resultado); $i++) {

    // Asignarle variables a los registros
    $nombre_herramienta = $resultado[$i]['nombre'];
    $marca_herramienta  = $resultado[$i]['marca_herramienta'];
    $serial_herramienta = $resultado[$i]['serial_herramienta'];
    $usuario            = $resultado[$i]['usuario'];

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
        $pdf->Cell($w_nombrehe, $row_height, 'Nombre Herramienta', 1, 0, 'C', 1);
        $pdf->Cell($w_marcahe, $row_height, 'Marca Herramienta', 1, 0, 'C', 1);
        $pdf->Cell($w_serialhe, $row_height, 'Serial Herramienta', 1, 1, 'C', 1);
        $pdf->Cell($w_usuario, $row_height, 'Usuario', 1, 1, 'C', 1);
        $j = 0;
    }

    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('FreeSerif', '', 10);
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
    $pdf->Cell($w_nombrehe, $row_height, $nombre_herramienta, 1, 0, 'C', 1);
    $pdf->Cell($w_marcahe, $row_height, $marca_herramienta, 1, 0, 'C', 1);
    $pdf->Cell($w_serialhe, $row_height, $serial_herramienta, 1, 0, 'C', 1);
    $pdf->Cell($w_usuario, $row_height, $usuario, 1, 1, 'C', 1);
    $j++;
}
/* * *************Linea de fin de hoja con la cantidad total de registros********************* */
$pdf->setCellMargins(0, 0, 0, 0);
$linea     = '------------------------------------------------------------------------------------------------------------------------------';
$pdf->Ln();
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(0, 0, $linea, 0, 0, 'L', 1);
$pdf->Ln(6);
//$pdf->Write(14, 'Registros:' . '' . $h);
$pdf->SetFont('FreeSerif', '', 10);
//$registros = 'Total de Registros:<span style="color:#FF0000;">' . $total . '</span>';
//$pdf->writeHTML($registros, true, false, true, false, 'R');
$pdf->Output('listado_herramientas.pdf', 'I');


