<?php
require "funcoes.php";
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pergunta = $_POST['pergunta'];
    salvar_pergunta("texto", $pergunta, "resposta livre");
    $msg = "Pergunta de texto cadastrada!";
}
?>
<!DOCTYPE html>
<html>
<head><title>Criar Pergunta de Texto</title></head>
<body>
<h1>Criar Pergunta de Texto</h1>
<a href="5_listar_todas.php">⬅ Voltar</a><br><br>
<?php if($msg) echo "<p style='color:green'>$msg</p>"; ?>
<form method="post">
    <label>Pergunta:</label><br>
    <input type="text" name="pergunta" required><br><br>
    <input type="submit" value="Salvar">
</form>
</body>
</html>
