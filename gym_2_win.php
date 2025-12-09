<?php
session_start();
$_SESSION["battle"] = null;

$previous="";
$next="";
if($_SESSION["starter"] == null){
    echo "AQUI DEU MERDA";
    $previous="fo";
    $next="deu";
    
}
elseif($_SESSION["starter"] == 'morcela'){
    $previous="Morc";
    $next="Morcela";
    $_SESSION['poke'][0] = [
            'Morcela' => [
                'img' => 'morcela.png',
                'maxHp' => 150,
                'hp'   => 150,
                'defeated' => false,
                'moves' => [
                    ['Picante Fodido' => 25],
                    ['Sangue De Porco' => 20],
                    ['Fumado no Forno da Tia Amelia' => 15],
                    ['Brasas Quentinhas'=> 30],
                ]
            ]
        ];
}
elseif($_SESSION["starter"] == 'aqua'){
    $previous="Agui";
    $next="Aguinha";
    $_SESSION['poke'][0] = [
            'Aguinha'=> [
                'img'=> 'garrafa.png',
                'maxHp' => 150,
                'hp'   => 150,
                'defeated' => false,
                'moves' => [
                    ['Hidratacao Gostosa' => 25],
                    ['Glugluglu' => 20],
                    ['Agua do Luso' => 30],
                    ['Plastico Reciclado' => 15],
                ]
            ]
        ];
}
elseif($_SESSION["starter"] == 'livro'){
    $previous="Pe-Ene-Ele";
    $next="Te-Xis-Te";
    $_SESSION['poke'][0] = [
            'Te-Xis-Te' => [
                'img'=> 'txt.png',
                'maxHp'=> 150,
                'hp'   => 150,
                'defeated' => false,
                'moves' => [
                    ['Json.txt' => 25],
                    ['README.md' => 20],
                    ['INSTALL.txt' => 15],
                    ['Typechart.txt' => 30],
                ],
            ]
        ];
}
$evolvedPokemon = reset($_SESSION['poke'][0]);
$evolvedImg = $evolvedPokemon['img'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POKEMORCELA</title>
    <link href="../css/basic.css" rel="stylesheet">
    <link href="../css/choice.css" rel="stylesheet">
</head>
<body>
    <h1> YOU WIN !!</h1>
    <h3><?= $previous ?> EVOLVED INTO <?= $next ?></h3>
    <img src="img/<?= $evolvedImg ?>" alt="<?= $next ?>">

    <a href="gym_3.php"><button>Continue</button></a>
</body>