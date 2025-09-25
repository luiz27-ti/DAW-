<?php
$arquivo = "3DAW_Luiz";


function ler_perguntas($arquivo) {
    $perguntas = [];
    $linhas = file($arquivo);
    for ($i = 1; $i < count($linhas); $i++) { 
        $dados = explode(";", trim($linhas[$i]));
        if (count($dados) == 6) {
            $perguntas[] = [
                "id" => $i, 
                "pergunta" => $dados[0],
                "a" => $dados[1],
                "b" => $dados[2],
                "c" => $dados[3],
                "d" => $dados[4],
                "correta" => $dados[5]
            ];
        }
    }
    return $perguntas;
}

function atualizar_pergunta($id, $pergunta, $a, $b, $c, $d, $correta) {
    global $arquivo;
    $linhas = file($arquivo);

   
    $linhas[$id] = $pergunta . ";" . $a . ";" . $b . ";" . $c . ";" . $d . ";" . $correta . "\n";

    file_put_contents($arquivo, implode("", $linhas));
}

$msg = "";
$perguntaEditar = null;

if (isset($_GET['id'])) {
   
    $todas = ler_perguntas($arquivo);
    foreach ($todas as $p) {
        if ($p['id'] == $_GET['id']) {
            $perguntaEditar = $p;
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $pergunta = $_POST['pergunta'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $correta = $_POST['correta'];

    atualizar_pergunta($id, $pergunta, $a, $b, $c, $d, $correta);
    $msg = "Pergunta alterada com sucesso!";
}

$perguntas = ler_perguntas($arquivo);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Alterar Pergunta Múltipla</title>
</head>
<body>
<h1>Alterar Pergunta de Múltipla Escolha</h1>
<a href="incluirMultipla.php">⬅ Voltar</a><br><br>

<?php if($msg) echo "<p style='color:green'>$msg</p>"; ?>

<?php if($perguntaEditar): ?>
    <form method="post">
        <input type="hidden" name="id" value="<?= $perguntaEditar['id'] ?>">
        Pergunta: <input type="text" name="pergunta" value="<?= $perguntaEditar['pergunta'] ?>"><br><br>
        Alternativa A: <input type="text" name="a" value="<?= $perguntaEditar['a'] ?>"><br>
        Alternativa B: <input type="text" name="b" value="<?= $perguntaEditar['b'] ?>"><br>
        Alternativa C: <input type="text" name="c" value="<?= $perguntaEditar['c'] ?>"><br>
        Alternativa D: <input type="text" name="d" value="<?= $perguntaEditar['d'] ?>"><br><br>
        Resposta correta:
        <select name="correta">
            <option value="A" <?= ($perguntaEditar['correta']=="A"?"selected":"") ?>>A</option>
            <option value="B" <?= ($perguntaEditar['correta']=="B"?"selected":"") ?>>B</option>
            <option value="C" <?= ($perguntaEditar['correta']=="C"?"selected":"") ?>>C</option>
            <option value="D" <?= ($perguntaEditar['correta']=="D"?"selected":"") ?>>D</option>
        </select><br><br>
        <input type="submit" value="Salvar Alterações">
    </form>
<?php else: ?>
    <h2>Perguntas cadastradas</h2>
    <table border="1">
        <tr>
            <th>ID</th><th>Pergunta</th><th>A</th><th>B</th><th>C</th><th>D</th><th>Correta</th><th>Ação</th>
        </tr>
        <?php foreach($perguntas as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['pergunta'] ?></td>
            <td><?= $p['a'] ?></td>
            <td><?= $p['b'] ?></td>
            <td><?= $p['c'] ?></td>
            <td><?= $p['d'] ?></td>
            <td><?= $p['correta'] ?></td>
            <td><a href="?id=<?= $p['id'] ?>">Editar</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
</body>
</html>

