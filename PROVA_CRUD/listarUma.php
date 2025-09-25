<?php
$arquivo = "3DAW_Luiz";

function ler_uma_pergunta($arquivo, $id) {
    $linhas = file($arquivo);
    if (!isset($linhas[$id])) return null;

    $dados = explode(";", trim($linhas[$id]));

    if (count($dados) == 3) {
        return [
            "id" => $id,
            "tipo" => $dados[0],
            "pergunta" => $dados[1],
            "respostas" => $dados[2]
        ];
    }
    elseif (count($dados) == 6) {
        return [
            "id" => $id,
            "tipo" => "multipla",
            "pergunta" => $dados[0],
            "a" => $dados[1],
            "b" => $dados[2],
            "c" => $dados[3],
            "d" => $dados[4],
            "correta" => $dados[5]
        ];
    }
    return null;
}

if (!isset($_GET['id'])) {
    header("Location: listarTodas.php");
    exit;
}

$id = $_GET['id'];
$pergunta = ler_uma_pergunta($arquivo, $id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ver Pergunta</title>
</head>
<body>
<h1>Detalhes da Pergunta</h1>
<a href="listarTodas.php">⬅ Voltar</a><br><br>

<?php if($pergunta): ?>
    <p><strong>ID:</strong> <?= $pergunta['id'] ?></p>
    <p><strong>Tipo:</strong> <?= ucfirst($pergunta['tipo']) ?></p>
    <p><strong>Pergunta:</strong> <?= $pergunta['pergunta'] ?></p>

    <?php if($pergunta['tipo'] == "multipla"): ?>
        <ul>
            <li><b>A)</b> <?= $pergunta['a'] ?></li>
            <li><b>B)</b> <?= $pergunta['b'] ?></li>
            <li><b>C)</b> <?= $pergunta['c'] ?></li>
            <li><b>D)</b> <?= $pergunta['d'] ?></li>
        </ul>
        <p><b>Resposta correta:</b> <?= $pergunta['correta'] ?></p>
    <?php else: ?>
        <p><b>Resposta esperada:</b> <?= $pergunta['respostas'] ?></p>
    <?php endif; ?>

<?php else: ?>
    <p style="color:red">Pergunta não encontrada!</p>
<?php endif; ?>

</body>
</html>

