<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio con Matrices</title>
    </head>
    <body>
        <?php
            // Ejercicio 1: Crear una matriz de colores y acceder al tercer elemento
            $colores = ["Rojo", "Azul", "Verde", "Amarillo", "Negro"];
            echo "El tercer color es: " . $colores[2] . "<br><br>"; // Imprime "Verde"

            // Ejercicio 2: Crear una matriz asociativa para un coche
            $coche = [
                "marca" => "Ford",
                "modelo" => "Fiesta",
                "año" => 2007
            ];
            echo "El modelo del coche es: " . $coche["modelo"] . "<br><br>"; // Imprime "Fiesta"

            // Ejercicio 3: Crear una matriz multidimensional para estudiantes
            $estudiantes = [
                ["nombre" => "Jose", "edad" => 21, "nota" => 10],
                ["nombre" => "Pepe", "edad" => 25, "nota" => 5],
                ["nombre" => "Sofia", "edad" => 18, "nota" => 8]
            ];
            echo "El nombre del segundo estudiante es: " . $estudiantes[1]["nombre"] . "<br><br>"; // Imprime "Ana"

            // Ejercicio 4: Crear una matriz con los días de la semana y usar print_r()
            $dias_semana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
            echo "<br>Días de la semana:<br><br>";
            print_r($dias_semana);

            // Ejercicio 5: Añadir dos números a una matriz de tres números
            $numeros = [1, 2, 3];
            array_push($numeros, 4, 5);
            echo "<br>Matriz con los números añadidos:<br><br>";
            print_r($numeros);

            // Ejercicio 6: Unir matrices de frutas y verduras
            $frutas = ["Manzana", "Platano", "Piña"];
            $verduras = ["Lechuga", "Zanahoria", "Espinaca"];
            $alimentos = array_merge($frutas, $verduras);
            echo "<br>Matriz unida de frutas y verduras:<br><br>";
            print_r($alimentos);

            // Ejercicio 7: Contar los elementos en una matriz
            echo "<br>La matriz tiene " . count($alimentos) . " elementos.<br><br>"; // Imprime el número de elementos

            // Ejercicio 8: Eliminar el tercer número en una matriz
            $numeros_a_eliminar = [1, 2, 3, 4, 5];
            unset($numeros_a_eliminar[2]); // Elimina el tercer número (3)
            echo "<br>Matriz después de eliminar el tercer número:<br><br>";
            print_r($numeros_a_eliminar);

            // Ejercicio 9: Copiar una matriz
            $matriz_original = ["uno", "dos", "tres"];
            $matriz_copiada = $matriz_original; // Copia la matriz
            echo "<br>Matriz copiada:<br><br>";
            print_r($matriz_copiada);

            // Ejercicio 10: Definir una constante con la velocidad de la luz
            define("VELOCIDAD_LUZ", 299792458); // en metros por segundo
            echo "<br>La velocidad de la luz es: " . VELOCIDAD_LUZ . " m/s<br><br>";

            // Ejercicio 11: Definir una constante para el nombre de una aplicación
            define("NOMBRE_APP", "MiAplicacionWeb");
            echo "El nombre de la aplicación es: " . NOMBRE_APP . "<br><br>";

            // Ejercicio 12: Usar la constante predefinida PHP_VERSION
            echo "La versión actual de PHP es: " . PHP_VERSION . "<br><br>";

            // Ejercicio 13: Mostrar todas las constantes predefinidas
            echo "Constantes predefinidas:<br>";
            print_r(get_defined_constants());
        ?>
    </body>
</html>