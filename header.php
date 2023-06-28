<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figuras</title>
    <style>
        *{box-sizing: border-box;}

        .col-1{width: 8.33%;}
        .col-2{width: 16.66%;}
        .col-3{width: 24.99%;}
        .col-4{width: 33.32%;}
        .col-5{width: 41.65%;}
        .col-6{width: 49.98%;}
        .col-7{width: 58.31%;}
        .col-8{width: 66.64%;}
        .col-9{width: 71.97%;}
        .col-10{width: 80.30%;}
        .col-10{width: 88.63%;}
        .col-11{width: 96.96%;}
        .col-12{width: 100%;}

        [class*="col"]{
            float: left;
            
            padding: 5px;
        }

        .row{
            clear: both;
        }
        ul{list-style: none;}
        a{text-decoration: none;}
    </style>
</head>
<body>
<nav>
    <ul>
        <div class="row">

        <div class='col-1'>
            <li><a href="../quadro/index.php">Início</a></li>
        </div>
        <div class='col-1'>
            <li><a href="../triangulo/index.php">Triângulo</a></li>
        </div>
        <div class='col-1'>
            <li><a href="../quadrado/index.php">Quadrado</a></li>
        </div>
        <div class='col-1'>
            <li><a href="../circulo/index.php">Círculo</a></li>
        </div>
        <div class='col-1'>
            <li><a href="../retangulo/index.php">Retângulo</a></li>
        </div>
        </div>
    </ul>
</nav>