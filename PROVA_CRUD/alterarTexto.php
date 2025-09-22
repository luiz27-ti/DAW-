<?php
require "funcoes.php";
$msg = "";

if (!isset($_GET['id'])) { header("Location: listarTodas.php"); exit; }

$id = $_GET['id'];
$linhas = file($arquivo);
$dados = explode(";", trim($linhas[$id]));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    atualizar_pergunta($id, "texto", $_POST['pergunta'], "resposta livre");
    $msg = "Pergunta de texto alterada!";
}
?>
<!DOCTYPE html>
<html>
<head><title>Alterar Pergunta Texto</title></head>
<body>
<h1>Alterar Pergunta de Texto</h1>
<a href="5_listar_todas.php">⬅ Voltar</a><br><br>
<?php if($msg) echo "<p style='color:green'>$msg</p>"; ?>
<form method="post">
    <label>Pergunta:</label><br>
    <input type="text" name="pergunta" value="<?php echo $dados[1]; ?>" required><br><br>
    <input type="submit" value="Salvar Alterações">
</form>
</body>
</html>

