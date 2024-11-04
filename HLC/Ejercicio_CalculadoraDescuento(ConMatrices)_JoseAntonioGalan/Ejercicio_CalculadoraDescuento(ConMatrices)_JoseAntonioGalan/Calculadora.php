<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calculadora de Descuentos</title>
    </head>
    <body>
        <h1>Resumen de la Compra</h1>

        <?php
            // Definir las constantes
            define("DESCUENTO_PEQUENO", 0.10);  // 10% de descuento
            define("DESCUENTO_ADICIONAL", 0.05); // 5% de descuento adicional
            define("LIMITE_DESCUENTO", 50);     // Límite para aplicar el primer descuento
            define("LIMITE_DESCUENTO_ADICIONAL", 100); // Límite para aplicar el descuento adicional
            define("LIMITE_COMPRA_GRANDE", 100); // Límite para considerar la compra como grande

            // Verificar si se han enviado los datos del formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productos'])) {
                // Inicializar matriz para almacenar los productos
                $productos = [];

                // Obtener los productos desde el formulario y almacenarlos en la matriz
                foreach ($_POST['productos'] as $index => $producto) {
                    $nombre = $producto['nombre'];
                    $cantidad = (int)$producto['cantidad'];  // Conversión explícita a entero
                    $precioUnitario = (float)$producto['precioUnitario']; // Conversión explícita a flotante

                    // Calcular el total sin descuento para cada producto
                    $totalSinDescuento = $cantidad * $precioUnitario;

                    // Verificar si el total sin descuento supera el límite para aplicar el descuento del 10%
                    $descuento = ($totalSinDescuento > LIMITE_DESCUENTO) ? DESCUENTO_PEQUENO : 0;

                    // Calcular el total con el primer descuento (10% si aplica)
                    $totalConDescuento = $totalSinDescuento - ($totalSinDescuento * $descuento);

                    // Verificar si el total con descuento supera 100€ para aplicar un 5% adicional
                    if ($totalConDescuento > LIMITE_DESCUENTO_ADICIONAL) {
                        $totalConDescuento = $totalConDescuento - ($totalConDescuento * DESCUENTO_ADICIONAL);
                    }

                    // Almacenar los datos en la matriz
                    $productos[] = [
                        'nombre' => $nombre,
                        'cantidad' => $cantidad,
                        'precioUnitario' => $precioUnitario,
                        'totalSinDescuento' => $totalSinDescuento,
                        'descuento' => $descuento,
                        'totalConDescuento' => $totalConDescuento
                    ];
                }

                // Inicializar el total global sin descuento
                $totalGlobalSinDescuento = 0;

                // Recorrer la matriz de productos para mostrar el resumen
                foreach ($productos as $producto) {
                    // Formatear los valores para mostrarlos correctamente
                    $precioUnitarioFormateado = number_format($producto['precioUnitario'], 2, ",", ".");
                    $totalSinDescuentoFormateado = number_format($producto['totalSinDescuento'], 2, ",", ".");
                    $totalConDescuentoFormateado = number_format($producto['totalConDescuento'], 2, ",", ".");
                    
                    // Mostrar el resumen del producto
                    echo "<h3>Producto: {$producto['nombre']}</h3>";
                    $cantidad = "<p>Cantidad: {$producto['cantidad']}</p>";
                    $precioU = "<p>Precio unitario: $precioUnitarioFormateado €</p>";
                    $totalS = "<p>Total sin descuento: $totalSinDescuentoFormateado €</p>";
                    $totalC = "<p>Total con descuento: $totalConDescuentoFormateado €</p>";
                    echo $cantidad . "". $precioU ."". $totalS . "". $totalC;

                    // Sumar el total sin descuento al total global
                    $totalGlobalSinDescuento += $producto['totalSinDescuento'];
                }

                // Formatear el total global
                $totalGlobalSinDescuentoFormateado = number_format($totalGlobalSinDescuento, 2, ",", ".");

                // Mostrar el total global sin descuento
                echo "<h3>Total Global sin Descuento: $totalGlobalSinDescuentoFormateado €</h3>";

                // Verificar si la compra es grande (mayor a 100€)
                if ($totalGlobalSinDescuento > LIMITE_COMPRA_GRANDE) {
                    echo "<p><strong>Compra grande.</strong></p>";
                } else {
                    echo "<p>Compra normal.</p>";
                }

                // Saltos de línea usando \n y nl2br
                $mensajeSaltoLinea = "Gracias por realizar su compra.\n¡Hasta la proxima!";
                echo nl2br($mensajeSaltoLinea); // Convertir los saltos de línea a <br>
            }
        ?>
    </body>
</html>
