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
        // Definir constantes para descuentos, límites e IVA
        define("DESCUENTO_PEQUENO", 0.10);       // 10% de descuento
        define("DESCUENTO_ADICIONAL", 0.05);     // 5% de descuento adicional
        define("LIMITE_DESCUENTO", 50);          // Límite para aplicar el primer descuento
        define("LIMITE_DESCUENTO_ADICIONAL", 100); // Límite para aplicar descuento adicional
        define("LIMITE_COMPRA_GRANDE", 100);     // Límite para considerar una compra grande
        define("IVA", 0.15);                     // IVA del 15%
        define("LIMITE_CANTIDAD_ADICIONAL", 40); // Límite de cantidad para aplicar descuento adicional

        // Verificar si se han enviado los datos del formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productos'])) {
            $productos = []; // Inicializar matriz para productos
            $totalGlobalSinDescuento = 0; // Acumulador del total sin descuento
            $cantidadTotalProductos = 0;  // Acumulador de cantidad total de productos

            // Procesar cada producto del formulario
            foreach ($_POST['productos'] as $index => $producto) {
                $nombre = $producto['nombre'];
                $cantidad = (int)$producto['cantidad'];
                $precioUnitario = (float)$producto['precioUnitario'];
                
                // Calcular el total sin descuento y actualizar la cantidad total de productos
                $totalSinDescuento = $cantidad * $precioUnitario;
                $cantidadTotalProductos += $cantidad;

                // Determinar el descuento del 10% si aplica
                $descuento = ($totalSinDescuento > LIMITE_DESCUENTO) ? DESCUENTO_PEQUENO : 0;
                $totalConDescuento = $totalSinDescuento - ($totalSinDescuento * $descuento);

                // Aplicar un descuento adicional del 5% si el total con descuento es superior a 100€
                if ($totalConDescuento > LIMITE_DESCUENTO_ADICIONAL) {
                    $totalConDescuento -= $totalConDescuento * DESCUENTO_ADICIONAL;
                }

                // Almacenar los datos del producto en la matriz
                $productos[] = [
                    'nombre' => $nombre,
                    'cantidad' => $cantidad,
                    'precioUnitario' => $precioUnitario,
                    'totalSinDescuento' => $totalSinDescuento,
                    'totalConDescuento' => $totalConDescuento,
                ];

                // Sumar al total global sin descuento
                $totalGlobalSinDescuento += $totalSinDescuento;
            }

            // Aplicar descuento adicional si la cantidad total supera el límite de cantidad
            if ($cantidadTotalProductos > LIMITE_CANTIDAD_ADICIONAL) {
                $totalGlobalConDescuento = $totalGlobalSinDescuento * (1 - DESCUENTO_ADICIONAL);
            } else {
                $totalGlobalConDescuento = $totalGlobalSinDescuento;
            }

            // Aplicar el IVA
            $totalConIVA = $totalGlobalConDescuento * (1 + IVA);

            // Determinar si la cantidad total es par o impar
            $paridadCantidad = ($cantidadTotalProductos % 2 == 0) ? "Par" : "Impar";

            // Calcular el precio promedio por producto
            $precioPromedio = $totalGlobalSinDescuento / max(1, $cantidadTotalProductos);

            // Formatear los valores
            $totalSinDescuentoFormateado = number_format($totalGlobalSinDescuento, 2, ",", ".");
            $totalConDescuentoFormateado = number_format($totalGlobalConDescuento, 2, ",", ".");
            $totalConIVAFormateado = number_format($totalConIVA, 2, ",", ".");
            $precioPromedioFormateado = number_format($precioPromedio, 2, ",", ".");

            // Mostrar el resumen de cada producto
            foreach ($productos as $producto) {
                echo "<h3>Producto: {$producto['nombre']}</h3>";
                echo "<p>Cantidad: {$producto['cantidad']}</p>";
                echo "<p>Precio unitario: " . number_format($producto['precioUnitario'], 2, ",", ".") . " €</p>";
                echo "<p>Total sin descuento: " . number_format($producto['totalSinDescuento'], 2, ",", ".") . " €</p>";
                echo "<p>Total con descuento: " . number_format($producto['totalConDescuento'], 2, ",", ".") . " €</p>";
            }

            // Mostrar el total global y otros datos
            echo "<h3>Total Global sin Descuento: $totalSinDescuentoFormateado €</h3>";
            echo "<h3>Total Global con Descuento: $totalConDescuentoFormateado €</h3>";
            echo "<h3>Total Global con IVA: $totalConIVAFormateado €</h3>";
            echo "<h3>Precio promedio por unidad: $precioPromedioFormateado €</h3>";
            echo "<h3>Cantidad Total de Productos: $cantidadTotalProductos ($paridadCantidad)</h3>";

            // Evaluar si la compra es grande
            if ($totalGlobalSinDescuento > LIMITE_COMPRA_GRANDE) {
                echo "<p><strong>Compra grande.</strong></p>";
            } else {
                echo "<p>Compra normal.</p>";
            }

            // Mensaje final de la compra con saltos de línea
            $mensajeFinal = "Gracias por su compra.\n¡Hasta la próxima!";
            echo nl2br($mensajeFinal);
        }
    ?>
</body>
</html>
