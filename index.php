<?php
  session_start();
  if( isset( $_SESSION['userid'] ) ){
    header( 'Location: gestion.php' );
    die();
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Inicio sesión</title>
</head>
<body>
    <section class="container mt-5 border rounded px-4 pt-5 pb-4 shadow-sm" style="max-width: 350px;">
        <h1>Iniciar sesión</h1>
        <form action="includes/login.php" method="post">
            <div class="my-3">
                <label for="cuenta" class="form-label">N° de cuenta</label>
                <input type="text" name="cuenta" class="form-control" id="cuenta" value="<?php if(isset($_SESSION['cuenta'])) echo $_SESSION['cuenta']; ?>">

                <?php if( isset( $_SESSION['errors']['cuenta'] ) ): ?>
                    <p class="form-text text-danger"><?= $_SESSION['errors']['cuenta']; ?></p>
                    <?php unset( $_SESSION['errors']['cuenta'] ) ?>
                <?php endif; ?>

            </div>
            <div class="mb-4">
                <label for="pin" class="form-label">PIN</label>
                <input type="password" name="pin" class="form-control" id="pin" maxlength="4">

                <?php if( isset( $_SESSION['errors']['pin'] ) ): ?>
                    <p class="form-text text-danger"><?= $_SESSION['errors']['pin'] ?></p>
                    <?php unset( $_SESSION['errors']['pin'] ) ?>
                <?php endif; ?>

            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            </div>

          </form>
          <?php if( isset( $_SESSION['user'] ) ) unset( $_SESSION['user'] ) ?>
    </section>
</body>
</html>