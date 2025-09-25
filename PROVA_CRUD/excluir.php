<?php
$arquivo = "3DAW_Luiz";
$msg = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $linhas = file($arquivo);

    if (isset($linhas[$id])) {
        unset($linhas[$id]); 
        file_put_contents($arquivo, implode("", $linhas));
        $msg = "Pergunta excluída com sucesso!";
    } else {
        $msg = "Pergunta não encontrada.";
    }
} else {
    $msg = "Nenhum ID informado.";
}
?>
<!DOCTYPE html>
<html>
<head><title>Excluir Pergunta</title></head>
<body>
<h1>Excluir Pergunta</h1>
<p style="color:green;"><?php echo $msg; ?></p>
<a href="listarTodas.php">⬅ Voltar para lista</a>
</body>
</html>

