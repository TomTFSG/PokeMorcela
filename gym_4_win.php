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
    $previous="Morcela";
    $next="Morcelazia do Aco";
    $_SESSION['poke'][0] = [
            'Morcelazia-do-Aco' => [
                'img' => 'morcelazia.png',
                'maxHp' => 250,
                'hp'   => 250,
                'defeated' => false,
                'moves' => [
                    ['Picante Fodilhao' => 50],
                    ['Banho de Sangue De Porco Inchado' => 60],
                    ['Estoiro na Focinha' => 70],
                    ['Soco Ardente do Aco'=> 90],
                ]
            ]
        ];
}
elseif($_SESSION["starter"] == 'aqua'){
    $previous="Aguinha";
    $next="Aguona";
    $_SESSION['poke'][0] = [
            'Aguona'=> [
                'img'=> 'garrafao.png',
                'maxHp' => 250,
                'hp'   => 250,
                'defeated' => false,
                'moves' => [
                    ['5 litros diarios' => 50],
                    ['Aaaah' => 60],
                    ['Agua da Serra do Caramulo' => 70],
                    ['Mijaneira Lixada' => 90],
                ]
            ]
        ];
}
elseif($_SESSION["starter"] == 'livro'){
    $previous="Te-Xis-Te";
    $next="Pe-De-Efe";
    $_SESSION['poke'][0] = [
            'Pe-De-Efe' => [
                'img'=> 'pdf.png',
                'maxHp'=> 250,
                'hp'   => 250,
                'defeated' => false,
                'moves' => [
                    ['doc.pdf' => 50],
                    ['Scan.pdf' => 60],
                    ['CC.pdf' => 70],
                    ['Entrega_FINAL_v.1.32.12.1103583_AGORA_SIM_CRL.pdf' => 90],
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

    <a href="gym_5.php"><button>Continue</button></a>
</body>