<?php 

$arquivoBanco = 'banco_de_dados.db';

// Verifica se o arquivo já existe
if (!file_exists($arquivoBanco)) {
    // Cria um novo banco de dados SQLite
    $db = new SQLite3($arquivoBanco);

    // Cria uma tabela no banco de dados
    $db->exec("CREATE TABLE usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT NOT NULL
    )");

    // Insere alguns dados na tabela
    $db->exec("INSERT INTO usuarios (nome, email) VALUES ('Gabriel Kreischer', 'gabriel@exemplo.com')");
    $db->exec("INSERT INTO usuarios (nome, email) VALUES ('Arthur Silva', 'arthur@exemplo.com')");

    echo "Banco de dados e tabela criados com sucesso!";
} else {
    echo "O banco de dados já existe!";
}

// Conecta ao banco de dados existente
$db = new SQLite3($arquivoBanco);

// Executa uma consulta SQL para ler os dados
$resultado = $db->query("SELECT * FROM usuarios");

// Exibe os resultados
echo "<h2>Lista de Usuários</h2>";
while ($linha = $resultado->fetchArray(SQLITE3_ASSOC)) {
    echo "ID: " . $linha['id'] . " - Nome: " . $linha['nome'] . " - Email: " . $linha['email'] . "<br>";
}

// Fecha a conexão com o banco de dados
$db->close();
?>