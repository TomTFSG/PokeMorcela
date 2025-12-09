<?php
session_start();
$_SESSION["battle"] = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selected = $_POST['poke'];
    $_SESSION['newPoke'] = $selected;


    if ($selected === 'pru') {
        $_SESSION['poke'][1] = [
            'Pru' => [
                'img' => 'pru.png',
                'maxHp' => 120,
                'hp'   => 120,
                'defeated' => false,
                'moves' => [
                    ['Cagar' => 25],
                    ['Estupidez de passaro' => 15],
                ]
            ]
        ];
    }

    if ($selected === 'rato') {
        $_SESSION['poke'][1] = [
            'Roberto'=> [
                'img'=> 'rat.png',
                'maxHp' => 120,
                'hp'   => 120,
                'defeated' => false,
                'moves' => [
                    ['Peste Negra' => 25],
                    ['Dentada Fodida' => 15],
                ]
            ]
        ];
    }

    if ($selected === 'gun') {
        $_SESSION['poke'][1] = [
            'Glock' => [
                'img'=> 'glock.png',
                'maxHp'=> 120,
                'hp'   => 120,
                'defeated' => false,
                'moves' => [
                    ['Bang' => 25],
                    ['Burst Fire' => 15],
                ],
            ]
        ];
    }

    header("Location: gym_2.php");
    exit();
}
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

<h2>Choose Your Second POKEMON</h2>

<form method="POST">
    <div class="character-container">

        <label class="char">
            <input type="radio" name="poke" value="pru" required>
            <img src="img/pru.png" alt="Warrior">
            <div>Pru</div>
        </label>

        <label class="char">
            <input type="radio" name="poke" value="rato">
            <img src="img/rat.png" alt="Mage">
            <div>Roberto</div>
        </label>

        <label class="char">
            <input type="radio" name="poke" value="gun">
            <img src="img/glock.png" alt="Archer">
            <div>Glock</div>
        </label>

    </div>

    <br>
    <button type="submit">Select</button>
</form>

</body>
</html>