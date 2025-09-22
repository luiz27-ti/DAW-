<?php
$arquivo = "3DAW_Luiz";


if (!file_exists($arquivo)) {
    file_put_contents($arquivo, "tipo;pergunta;respostas\n");
}

function ler_perguntas($arquivo) {
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
    }
    return $perguntas;
}

function salvar_pergunta($tipo, $pergunta, $respostas) {
    global $arquivo;
    $linha = $tipo . ";" . $pergunta . ";" . $respostas . "\n";
    file_put_contents($arquivo, $linha, FILE_APPEND);
}

function atualizar_pergunta($id, $tipo, $pergunta, $respostas) {
    global $arquivo;
    $linhas = file($arquivo);
    $linhas[$id] = $tipo . ";" . $pergunta . ";" . $respostas . "\n";
    file_put_contents($arquivo, implode("", $linhas));
}

function excluir_pergunta($id) {
    global $arquivo;
    $linhas = file($arquivo);
    unset($linhas[$id]);
    file_put_contents($arquivo, implode("", $linhas));
}
