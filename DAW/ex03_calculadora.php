<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calculadora Simples</title>
</head>
<body>
    <h1>Calculadora</h1>

    <form method="get">
        <label for="a">Valor 1:</label>
        <input type="number" name="a" id="a" required><br><br>

        <label for="b">Valor 2:</label>
        <input type="number" name="b" id="b" required><br><br>

        <label for="op">Operação:</label>
        <select name="op" id="op">
            <option value="Soma">Soma</option>
            <option value="Subtração">Subtração</option>
            <option value="Multiplicação">Multiplicação</option>
            <option value="Divisão">Divisão</option>
        </select><br><br>

        <button type="submit">Calcular</button>
    </form>

    <?php
        if (isset($_GET["a"]) && isset($_GET["b"]) && isset($_GET["op"])) {
            $v1 = $_GET["a"];
            $v2 = $_GET["b"];
            $opper = $_GET["op"];
            $result = 0;

            switch ($opper) {
                case "Soma":
                    $result = $v1 + $v2;
                    break;
                case "Subtracao":
                    $result = $v1 - $v2;
                    break;
                case "Multiplicacao":
                    $result = $v1 * $v2;
                    break;
                case "Divisao":
                    if ($v2 != 0) {
                        $result = $v1 / $v2;
                    } else {
                        $result = "Erro: Divisão por zero!";
                    }
                    break;
            }

            echo "<h2>Resultado = $result </h2>";
        }
    ?>
</body>
</html>
