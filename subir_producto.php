<?php
$api_url = "https://almacen-qr.onrender.com/";

// Recolectar los datos del formulario
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$stock = $_POST['stock'];
$ubicacion = $_POST['ubicacion'];
$precio = $_POST['precio'];
$costo = $_POST['costo'];
$file = $_FILES['file'];

// Preparar el archivo
$file_tmp = $file['tmp_name'];
$file_name = $file['name'];

// Armar el form-data
$data = [
    'codigo' => $codigo,
    'nombre' => $nombre,
    'stock' => $stock,
    'ubicacion' => $ubicacion,
    'precio' => $precio,
    'costo' => $costo,
    'file' => new CURLFile($file_tmp, $file['type'], $file_name)
];

// Enviar a la API por cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Mostrar resultado
if ($http_code === 201) {
    echo "<h2>✅ Producto guardado correctamente</h2>";
} else {
    echo "<h2>❌ Error al guardar el producto. Respuesta:</h2>";
    echo "<pre>$response</pre>";
}
?>
