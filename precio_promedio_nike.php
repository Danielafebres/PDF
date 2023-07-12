<?php
// Incluir la librería DOMPDF
require_once 'libreria/dompdf/autoload.inc.php';

// Crear un objeto DOMPDF
$dompdf = new Dompdf\Dompdf();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "pdf_dani");

// Consulta SQL
$sql = "SELECT AVG(precio) AS promedio FROM calzado WHERE marca='Nike'";

// Ejecutar consulta y obtener resultado
$resultado = $conexion->query($sql);
$datos = $resultado->fetch_assoc();

// Mostrar resultado
$html = "El precio promedio de los zapatos Nike es: $" . $datos['promedio'];

// Cerrar conexión
$conexion->close();

// Cargar el contenido HTML en DOMPDF
$dompdf->loadHtml($html);

// Establecer la orientación y tamaño de página del PDF
$dompdf->setPaper('A4', 'portrait');

// Renderizar el contenido HTML en PDF
$dompdf->render();

// Establecer el nombre del archivo PDF generado
$filename = 'precio_promedio_nike.pdf';

// Enviar el archivo PDF al navegador para su descarga
$dompdf->stream($filename, array("Attachment" => false));
?>