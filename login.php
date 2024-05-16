<?php
include_once("php/LigarBD.php");
session_start();

// Limpa a variável de erro ao carregar a página
$error = "";
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="CSS/Login.css">
  <link rel="stylesheet" href="CSS/bootstrap.css">
  <link rel="stylesheet" href="CSS/index.css">
  <script src="js/bootstrap.bundle.min.js"></script>
  <title>Login</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary" id="navbar">
    <div class="container-fluid">
      <a class="navbar-brand py-3" href="index.html" id="text-t">
        <img src="img/logo.svg" height="30px" class="d-inline-block align-top" alt="Logo Mix Music">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html" id="text">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="biblioteca.html" id="text">Biblioteca</a>
          </li>

          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="playlists.html" id="text">Playlists</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="liked.html" id="text">Liked</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="prime.html" id="text">Premium</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="text">
              Dropdown
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="colaboracao.html">Colaboração com artistas</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Outras Opeções</a></li>
            </ul>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php" id="text">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="register.html" id="text">Registar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php
  require_once "php/partials/msg_sucesso.php";
  require_once "php/partials/msg_erros.php";
  ?>

  <div id="a">
    <div id="b">
      <img src="img/telefone.png" alt="png" height="750px" width="770px">
    </div>

    <div id="c">
      <h2 id="v">Bem Vindo!</h2>
      <form class="tab" action="php/login_process.php" method="POST">
        <label id="abcd" for="username">Username/Email:</label>
        <input type="text" id="username" name="username">
        <label id="abcd" for="password">Password:</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Login">
        <a href="#">Esqueceu a sua senha?</a>
        <a href="register.html">Criar uma nova conta</a>
      </form>
    </div>
  </div>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Consulta para buscar o usuário no banco de dados
    $sql = "SELECT email, pass FROM utilizador WHERE email = '$email' AND pass = '$pass'";
    $result = mysqli_query($conn, $sql);

    // Verifica se o usuário foi encontrado
    if (mysqli_num_rows($result) == 1) {
      // Inicia uma sessão e redireciona para a página de perfil
      $_SESSION['email'] = $email;
      exit(); // Termina o script para garantir que a página não seja renderizada novamente
    } else {
      // Define a mensagem de erro
      $_SESSION['error'] = "Nome de usuário ou senha incorretos.";
      // Redireciona para a mesma página para exibir a mensagem de erro
      exit(); // Termina o script para garantir que a página não seja renderizada novamente
    }
  }

  // Verifica se há uma mensagem de erro na sessão
  if (isset($_SESSION['error'])) {
    // Exibe a mensagem de erro e limpa a sessão
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
  }

  include_once("php/partials/verifica_login.php");
  ?>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1" id="cr">© 2023 DWM</p>
    <ul class="list-inline footer-links">
      <li class="list-inline-item"><a href="index.html">Home</a></li>
      <li class="list-inline-item"><a href="sobrenos.html">Sobre nós</a></li>
      <li class="list-inline-item"><a href="termos.html">Termos e condições</a></li>
      <li class="list-inline-item"><a href="https://www.instagram.com" target="_blank">
          <img src="img/instagram-w.png" height="30px" class="d-inline-block align-top" alt="Instagram">
        </a></li>
      <li class="list-inline-item"><a href="https://www.facebook.com" target="_blank">
          <img src="img/facebook-w.png" height="30px" class="d-inline-block align-top" alt="Facebook">
        </a></li>
    </ul>
  </footer>

</html>
</body>

</html>
