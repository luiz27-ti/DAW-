<?php
$arquivo = "3DAW_Luiz";

if (!file_exists($arquivo)) {
    file_put_contents($arquivo, "pergunta;a;b;c;d;correta\n");
}


if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
    $pergunta = $_POST['pergunta'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $correta = $_POST['correta'];

    $linha = $pergunta . ";" . $a . ";" . $b . ";" . $c . ";" . $d . ";" . $correta . "\n";
    file_put_contents($arquivo, $linha, FILE_APPEND);
    $msg = "Pergunta de múltipla escolha cadastrada!";
}


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

$perguntas = ler_perguntas($arquivo);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Pergunta Múltipla</title>
</head>
<body>
<h1>Criar Pergunta de Múltipla Escolha</h1>

<form method="post">
    <input type="hidden" name="acao" value="cadastrar">
    Pergunta: <input type="text" name="pergunta"><br><br>
    Alternativa A: <input type="text" name="a"><br>
    Alternativa B: <input type="text" name="b"><br>
    Alternativa C: <input type="text" name="c"><br>
    Alternativa D: <input type="text" name="d"><br><br>
    Resposta correta:
    <select name="correta">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select><br><br>
    <input type="submit" value="Cadastrar">
</form>

<h2>Perguntas já cadastradas</h2>
<table border="1">
    <tr>
        <th>ID</th><th>Pergunta</th><th>A</th><th>B</th><th>C</th><th>D</th><th>Correta</th>
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
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>


