<?php
$arquivo = "3DAW_Luiz";

function ler_todas_perguntas($arquivo) {
    $perguntas = [];
    $linhas = file($arquivo);


    for ($i = 1; $i < count($linhas); $i++) {
        $dados = explode(";", trim($linhas[$i]));

     
        if (count($dados) == 3) {
            $perguntas[] = [
                "id" => $i,
                "tipo" => $dados[0],
                "pergunta" => $dados[1],
                "respostas" => $dados[2]
            ];
        }
    
        elseif (count($dados) == 6) {
            $perguntas[] = [
                "id" => $i,
                "tipo" => "multipla",
                "pergunta" => $dados[0],
                "respostas" => "A) {$dados[1]} | B) {$dados[2]} | C) {$dados[3]} | D) {$dados[4]} | Correta: {$dados[5]}"
            ];
        }
    }

    return $perguntas;
}

$perguntas = ler_todas_perguntas($arquivo);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Perguntas</title>
</head>
<body>
<h1>Lista de Perguntas</h1>
<a href="incluirMultipla.php"> Nova Pergunta Múltipla</a> |
<a href="incluirTexto.php"> Nova Pergunta Texto</a>
<br><br>
<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Tipo</th>
        <th>Pergunta</th>
        <th>Respostas</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($perguntas as $p): ?>
    <tr>
        <td><?php echo $p['id']; ?></td>
        <td><?php echo ucfirst($p['tipo']); ?></td>
        <td><?php echo $p['pergunta']; ?></td>
        <td><?php echo $p['respostas']; ?></td>
        <td>
            <?php if($p['tipo']=="multipla"): ?>
                <a href="alterarMultipla.php?id=<?php echo $p['id']; ?>"> Editar</a>
            <?php else: ?>
                <a href="alterarTexto.php?id=<?php echo $p['id']; ?>"> Editar</a>
            <?php endif; ?>
            | <a href="excluir.php?id=<?php echo $p['id']; ?>"> Excluir</a> 
            | <a href="listarUma.php?id=<?php echo $p['id']; ?>"> Ver</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>

