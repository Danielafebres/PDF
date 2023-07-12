<?php
// Incluir la librería DOMPDF
require_once 'libreria/dompdf/autoload.inc.php';

// Crear un objeto DOMPDF
$dompdf = new Dompdf\Dompdf();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "pdf_dani");

// Consulta SQL
$sql = "SELECT marca, COUNT(*) AS cantidad FROM calzado GROUP BY marca";

// Ejecutar consulta y obtener resultado
$resultado = $conexion->query($sql);

// Mostrar resultado
$html = "<h1>número total de zapatos:</h1>";
while ($datos = $resultado->fetch_assoc()) {
  $html .= "Hay " . $datos['cantidad'] . " zapatos de la marca " . $datos['marca'] . "<br>";
}

// Cerrar conexión
$conexion->close();

// Cargar el contenido HTML en DOMPDF
$dompdf->loadHtml($html);

// Establecer la orientación y tamaño de página del PDF
$dompdf->setPaper('A4', 'portrait');

// Renderizar el contenido HTML en PDF
$dompdf->render();

// Establecer el nombre del archivo PDF generado
$filename = 'cantidad_zapatos_por_marca.pdf';

// Enviar el archivo PDF al navegador para su descarga
$dompdf->stream($filename, array("Attachment" => false));
?>