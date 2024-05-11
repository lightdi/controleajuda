<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle de Ajuda RS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">AjudaRS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Quem precisa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Quem doa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Quem transporta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Gerenciamento</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin.php">Admin</a>
        </li>

  
      </ul>
      <form class="d-flex" role="search">
      <?php
                if ( isset($loged))
                {
                    if ($loged) {
                        echo '<div class="container-fluid">';
                        echo '<p class="navbar-brand" >Usuário: ' . $nome . '('. $email . ')</p>';
                        echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
                        echo '<span class="navbar-toggler-icon"></span>';
                        echo '</button>';
                        echo '<a class="btn btn btn-danger" href="sair.php" role="button">Sair</a>';
                        echo '</div>';
                    }
                }else{
                    echo '<form class="d-flex" role="search" action="" method="post">';
                    echo '<input class="form-control me-2" type="email" name="email" placeholder="Digite seu email" aria-label="Entrar">';
                    echo '&nbsp;';
                    echo '<input class="form-control me-2" type="password" name="senha" placeholder="Digite sua senha" aria-label="Entrar">';
                    echo '&nbsp;';
                    echo '<button class="btn btn-outline-success" type="submit">Entrar</button>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-outline-success" href="registrar.php">Registrar</a>';
                    echo '</form>';

                }
                
                
            ?>
      </form>
    </div>
  </div>
</nav>
    
  
  </body>
</html>
