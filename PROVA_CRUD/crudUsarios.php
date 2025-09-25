<?php

$arquivoUsuarios = "3DAW_Luiz";
$arquivoPerguntas = "3DAW_Luiz";

if (!file_exists($arquivoUsuarios)) {
    file_put_contents($arquivoUsuarios, "nome;email;senha\n");
}
if (!file_exists($arquivoPerguntas)) {
    file_put_contents($arquivoPerguntas, "pergunta;resposta\n");
}


function ler_registros($arquivo, $camposEsperados) {
    $dados = [];
    $linhas = file($arquivo);
    for ($i = 1; $i < count($linhas); $i++) {
        $colunas = explode(";", trim($linhas[$i]));
        if (count($colunas) == $camposEsperados) {
            $dados[] = array_merge(["id" => $i], $colunas);
        }
    }
    return $dados;
}


$page = $_GET['page'] ?? 'home';
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Unificado</title>
</head>
<body>
    <h1>CRUD Unificado (Usuários + Perguntas)</h1>
    <nav>
        <a href="?page=home"> Home</a> |
        <a href="?page=usuarios_listar"> Usuários</a> |
        <a href="?page=usuarios_incluir"> Usuário</a> |
        <a href="?page=perguntas_listar"> Perguntas</a> |
        <a href="?page=perguntas_incluir"> Pergunta</a>
    </nav>
    <hr>

    <?php

    if ($page == "home") {
        echo "<h2>Bem-vindo ao CRUD Unificado!</h2>";
        echo "<p>Escolha Usuários ou Perguntas no menu.</p>";
    }


    elseif ($page == "usuarios_listar") {
        $usuarios = ler_registros($arquivoUsuarios, 3);
        echo "<h2>Lista de Usuários</h2>";
        echo "<table border=1><tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr>";
        foreach ($usuarios as $u) {
            echo "<tr>
                <td>{$u['id']}</td>
                <td>{$u[0]}</td>
                <td>{$u[1]}</td>
                <td>
                    <a href='?page=usuarios_alterar&id={$u['id']}'>Editar</a> |
                    <a href='?page=usuarios_excluir&id={$u['id']}'>Excluir</a>
                </td>
            </tr>";
        }
        echo "</table>";
    }

    
    elseif ($page == "usuarios_incluir") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $linha = $_POST['nome'] . ";" . $_POST['email'] . ";" . $_POST['senha'] . "\n";
            file_put_contents($arquivoUsuarios, $linha, FILE_APPEND);
            echo "<p style='color:green'>Usuário cadastrado!</p>";
        }
        ?>
        <h2>Cadastrar Usuário</h2>
        <form method="post">
            Nome: <input type="text" name="nome" required><br>
            Email: <input type="email" name="email" required><br>
            Senha: <input type="password" name="senha" required><br>
            <input type="submit" value="Salvar">
        </form>
        <?php
    }

   
    elseif ($page == "usuarios_alterar" && isset($_GET['id'])) {
        $linhas = file($arquivoUsuarios);
        $dados = explode(";", trim($linhas[$_GET['id']]));
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $linhas[$_POST['id']] = $_POST['nome'].";".$_POST['email'].";".$_POST['senha']."\n";
            file_put_contents($arquivoUsuarios, implode("", $linhas));
            echo "<p style='color:green'>Usuário atualizado!</p>";
            $dados = [$_POST['nome'], $_POST['email'], $_POST['senha']];
        }
        ?>
        <h2>Editar Usuário</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            Nome: <input type="text" name="nome" value="<?= $dados[0] ?>" required><br>
            Email: <input type="email" name="email" value="<?= $dados[1] ?>" required><br>
            Senha: <input type="text" name="senha" value="<?= $dados[2] ?>" required><br>
            <input type="submit" value="Salvar">
        </form>
        <?php
    }

   
    elseif ($page == "usuarios_excluir" && isset($_GET['id'])) {
        $linhas = file($arquivoUsuarios);
        unset($linhas[$_GET['id']]);
        file_put_contents($arquivoUsuarios, implode("", $linhas));
        echo "<p style='color:green'>Usuário excluído!</p>";
        echo "<a href='?page=usuarios_listar'>Voltar</a>";
    }

    
    elseif ($page == "perguntas_listar") {
        $perguntas = ler_registros($arquivoPerguntas, 2);
        echo "<h2>Lista de Perguntas</h2>";
        echo "<table border=1><tr><th>ID</th><th>Pergunta</th><th>Resposta</th><th>Ações</th></tr>";
        foreach ($perguntas as $p) {
            echo "<tr>
                <td>{$p['id']}</td>
                <td>{$p[0]}</td>
                <td>{$p[1]}</td>
                <td>
                    <a href='?page=perguntas_alterar&id={$p['id']}'>Editar</a> |
                    <a href='?page=perguntas_excluir&id={$p['id']}'>Excluir</a>
                </td>
            </tr>";
        }
        echo "</table>";
    }

    
    elseif ($page == "perguntas_incluir") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $linha = $_POST['pergunta'] . ";" . $_POST['resposta'] . "\n";
            file_put_contents($arquivoPerguntas, $linha, FILE_APPEND);
            echo "<p style='color:green'>Pergunta cadastrada!</p>";
        }
        ?>
        <h2>Cadastrar Pergunta</h2>
        <form method="post">
            Pergunta: <input type="text" name="pergunta" required><br>
            Resposta: <input type="text" name="resposta" required><br>
            <input type="submit" value="Salvar">
        </form>
        <?php
    }

  
    elseif ($page == "perguntas_alterar" && isset($_GET['id'])) {
        $linhas = file($arquivoPerguntas);
        $dados = explode(";", trim($linhas[$_GET['id']]));
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $linhas[$_POST['id']] = $_POST['pergunta'].";".$_POST['resposta']."\n";
            file_put_contents($arquivoPerguntas, implode("", $linhas));
            echo "<p style='color:green'>Pergunta atualizada!</p>";
            $dados = [$_POST['pergunta'], $_POST['resposta']];
        }
        ?>
        <h2>Editar Pergunta</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            Pergunta: <input type="text" name="pergunta" value="<?= $dados[0] ?>" required><br>
            Resposta: <input type="text" name="resposta" value="<?= $dados[1] ?>" required><br>
            <input type="submit" value="Salvar">
        </form>
        <?php
    }

    elseif ($page == "perguntas_excluir" && isset($_GET['id'])) {
        $linhas = file($arquivoPerguntas);
        unset($linhas[$_GET['id']]);
        file_put_contents($arquivoPerguntas, implode("", $linhas));
        echo "<p style='color:green'>Pergunta excluída!</p>";
        echo "<a href='?page=perguntas_listar'>Voltar</a>";
    }

    else {
        echo "<p style='color:red'>Página não encontrada.</p>";
    }
    ?>
</body>
</html>

