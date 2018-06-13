<?php 
    // session_start inicia a sessão
    session_start();
    // as variáveis login e senha recebem os dados digitados na página anterior
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // variáveis de banco de dados

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "feetshoesdb";
    $port = "3306";

    // Cria a conexão
 
    $conn = new mysqli($servername, $username, $password, $database, $port);
    $conn->set_charset('utf8');

    // Verifica se a conexão foi estabelecida

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
    $result = mysqli_query($conn, "SELECT * FROM TB_CLIENTE WHERE EMAIL = '$login' AND SENHA = '$senha'");

    /* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi bem sucedida, ou seja se ela estiver encontrado algum registro idêntico o seu valor será igual a 1, se não, se não tiver registros seu valor será 0. Dependendo do resultado ele redirecionará para a pagina site.php ou retornara  para a pagina do formulário inicial para que se possa tentar novamente realizar o login */

    if(mysqli_num_rows ($result) > 0 )
    {
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        header('location:site.php');
    }
    else
    {
        unset ($_SESSION['login']);
        unset ($_SESSION['senha']);
        header('location:index.php');
    }
 
?>