<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
    .btn-inicio,
    .btn-cerrar {
        background-color: #8c52ff !important;
        color: white !important;
        border: none;
        padding: 8px 12px;
        font-size: 18px;
        border-radius: 8px;
        cursor: pointer;
        opacity: 1 !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        transition: background 0.3s ease, transform 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-inicio:hover,
    .btn-cerrar:hover {
        background-color: #6e3fcf !important;
        transform: translateY(-2px);
    }
    body{
        background-color: lightblue;
    }
</style>
<body>

    <div class="container ">
        <!-- header -->
        <div class="row">
            <div class="col-1">
                <a class="navbar-brand" href="" data-bs-toggle="offcanvas" data-bs-target="#menu">
                    <span style="font-size: 35px;">☰</span>
                </a>
            </div>
            <div class="col-1">
                <a href="info.html">
                    <img src="../otros/logo_transparente.png" alt="logo" style="width:110px;">
                </a>
            </div>
            <div class="col">
                <div style="margin-left:auto; text-align:right;">
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <a href="logout.php" class="btn-cerrar">Cerrar Sesión</a>
                    <?php else: ?>
                        <a href="login.php" class="btn-inicio">Iniciar Sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- chat -->
        <div class="row">
            <div class="col-8 border ">
                <div class="card my-3">
                    <div class="card-header text-uppercase text-center">
                        ChatBoot
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- input -->
        <div class="row my-5 p-2">
            <div class="col-8 border">
                <div class="card my-3">
                    <div class="card-header">
                        Ingrese su consulta:
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <textarea class="form-control" id=""></textarea>
                        </div>
                        <button class="btn btn-success form-control">Enviar</button>
                    </div>
                </div>
            </div>

        </div>

        <!-- foother -->
        <div class="row">
            <div class="col-6 bg-info">hola</div>
            <div class="col-6 bg-danger">¿como estas?</div>
        </div>
        <div class="row">
            <div class="col-6 bg-danger">hola</div>
            <div class="col-6 bg-info">¿como estas?</div>
        </div>
    </div>
    </div>
</body>

</html>