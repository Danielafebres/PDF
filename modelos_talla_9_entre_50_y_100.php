<?php
// Incluir la librería DOMPDF
require_once 'libreria/dompdf/autoload.inc.php';

// Crear un objeto DOMPDF
$dompdf = new Dompdf\Dompdf();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "pdf_dani");

// Consulta SQL
$sql = "SELECT modelo, precio FROM calzado WHERE talla='9' AND precio BETWEEN 50 AND 100";

// Ejecutar consulta y obtener resultado


// Cerrar conexión
$conexion->close();

// Cargar el contenido HTML en DOMPDF
$dompdf->loadHtml($html);

// Establecer la orientación y tamaño de página del PDF
$dompdf->setPaper('A4', 'portrait');

// Renderizar el contenido HTML en PDF
$dompdf->render();

// Establecer el nombre del archivo PDF generado
$filename = 'modelos_talla_9_entre_50_y_100.pdf';

// Enviar el archivo PDF al navegador para su descarga
$dompdf->stream($filename, array("Attachment" => false));
?>