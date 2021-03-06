<!DOCTYPE html>
<html lang="es">
<?php
session_start();
include_once("Controllers/MainController.php");
?>
<head>
    <title><?php echo $title ?></title>
    <link rel="shortcut icon" href="/Files/favicon.ico"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="/Views/Styles/main.css">
    <link rel="stylesheet" href="/Views/Styles/cliente.css">
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <?php $pageHref = "login";
    if (isset($_SESSION["userPrivileges"]) && $_SESSION["userPrivileges"] == 1) $pageHref = "contabilidad"; ?>
    <p class="font-weight-bolder font-italic"><a class="navbar-brand" href="?page=<?php echo $pageHref?>">Carpintería José
            Octavio</a></p>
    <p class="font-weight-bolder font-italic text-right navbar-brand"><small>&copy;Jonathan Rodríguez</small></p>
    <?php if (isset($_SESSION["userPrivileges"]) && $_SESSION["userPrivileges"] == 1) { ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="?page=contabilidad"><i class="material-icons">home</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=ingresos">Ingresos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=gastos">Gastos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=balance">Balance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=login&logout=yes"><i class="material-icons">exit_to_app</i></a>
                </li>
                <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuario
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Cuenta</a>
                        <a class="dropdown-item" href="?page=login&logout=yes">Logout<br><i class="material-icons">exit_to_app</i></a>
                    </div>
                </li>-->
            </ul>
        </div>
    <?php } ?>
</nav>

</header>
<main>
<div class="container">
<?php include_once("Views/".$page.".php"); ?>