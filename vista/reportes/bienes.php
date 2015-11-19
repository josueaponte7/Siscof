<?php

define('BASEPATH', '');
require_once '../../modelo/fallas/AsignarFalla.php';
require_once './tcpdf/spa.php';
require_once './tcpdf/MyClass.php';
//$obj  = new Conexion();

$obj           = new AsignarFalla();

//$total         = $obj->totalFilas('fallas fa', 'id_falla fa', $campos['condicion']);

$pdf = new MyClassL("L", "mm", "A4", true, 'UTF-8', false);

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
$titulo = "LISTADO DE BIENES";
$pdf->Ln(5);
$pdf->SetX(60);
// fuente y tamaño de letra 
$pdf->SetFont('FreeSerif', 'B', 14);
// añadimos el titulo
$pdf->Cell(180, 0, $titulo, 0, 0, 'C', 0);
$pdf->Ln(15);

/* * ********************************** */



$j            = 0;
// Cantidad maxima de registros a mostrar por pagina
$max          = 35;
$row_height   = 6;
$backup_group = "";


// width de las filas 

$w_problema     = 30;
$w_numero       = 30;
$w_nombre       = 80;
$w_usuario      = 30;
$w_departamento = 95;
// Mover a la derecha 
$pdf->SetX(16);

// Color Cabecera de la tabla
$pdf->SetFillColor(39, 129, 213);
$pdf->SetFont('FreeSerif', 'B', 11);
// Titulos de la Cabecera
$pdf->Cell($w_problema, $row_height, 'Num del Bien', 1, 0, 'C', 1);
$pdf->Cell($w_numero, $row_height, 'Cod del Bien', 1, 0, 'C', 1);
$pdf->Cell($w_nombre, $row_height, 'Nombre del Bien', 1, 0, 'C', 1);
$pdf->Cell($w_usuario, $row_height, 'Usuario', 1, 0, 'C', 1);
$pdf->Cell($w_departamento, $row_height, 'Departamento', 1, 1, 'C', 1);

$sql = "SELECT 
b.numero_bien,b.codigo_bien,b.nombre_bien,concat(uf.nombre,' ',uf.apellido) as usuario,d.nombre_departamento 
FROM bien as b
inner join usuario_f as uf on b.usuariof_id=uf.id
inner join departamento as d on uf.departamento_id=d.id
order BY d.nombre_departamento;";

$resultado   = $obj->ex_query($sql);

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
        $pdf->SetFont('FreeSerif', 'B', 11);

        $pdf->SetX(60);
        // Titulo del Reporte width:90 heigth:0 text:$titulo alineacion:C
        $pdf->Cell(90, 0, $titulo, 0, 0, 'C', 0);
        $pdf->Ln(15);
        
       
        
        // Color Cabecera de la tabla
        $pdf->SetFillColor(39, 129, 213);
        $pdf->SetX(10);
        $pdf->Cell($w_problema, $row_height, 'Num del Bien', 1, 0, 'C', 1);
        $pdf->Cell($w_numero, $row_height, 'Cod del Bien', 1, 0, 'C', 1);
        $pdf->Cell($w_nombre, $row_height, 'Nombre del Bien', 1, 0, 'C', 1);
        $pdf->Cell($w_usuario, $row_height, 'Usuario', 1, 0, 'C', 1);
        $pdf->Cell($w_departamento, $row_height, 'Departamento', 1, 1, 'C', 1);
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
    $numero_bien         = $resultado[$i]['numero_bien'];
    $codigo_bien         = $resultado[$i]['codigo_bien'];
    $nombre_bien         = $resultado[$i]['nombre_bien'];
    
    $nombre_departamento = $resultado[$i]['nombre_departamento'];
    $usuario             = $resultado[$i]['usuario'];
    // crear los registros a mostrar
    $pdf->SetFont('FreeSerif', '', 10);
    $pdf->SetX(16);
    $pdf->Cell($w_problema, $row_height, $numero_bien, 1, 0, 'C', 1);
    $pdf->Cell($w_numero, $row_height, $codigo_bien, 1, 0, 'C', 1);
    $pdf->Cell($w_nombre, $row_height, $nombre_bien, 1, 0, 'C', 1);
    $pdf->Cell($w_usuario, $row_height,$usuario , 1, 0, 'C', 1);
    $pdf->Cell($w_departamento, $row_height, $nombre_departamento, 1, 1, 'C', 1);
    $j++;
}
/* * *************Linea de fin de hoja con la cantidad total de registros********************* */
$pdf->setCellMargins(0, 0, 0, 0);
$linea = '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------';
$pdf->Ln();
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(0, 0, $linea, 0, 0, 'L', 1);
$pdf->Ln(6);
//$pdf->Write(14, 'Registros:' . '' . $h);
$pdf->SetFont('FreeSerif', '', 10);
$registros = 'Total de Registros:<span style="color:#FF0000;">' . $total . '</span>';
$pdf->writeHTMLCell(135, 6, 148,'', $registros, 0, 0, false, true, 'R', true);
$pdf->Output('listado_fallas.pdf', 'I');


