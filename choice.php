<?php
session_start();

if (!isset($_SESSION['poke'])) {
    $_SESSION['poke'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selected = $_POST['poke'];
    $_SESSION['starter'] = $selected;

    if ($selected === 'morcela') {
        $_SESSION['poke'][0] = [
            'Morc' => [
                'img' => 'morc.png',
                'maxHp' => 100,
                'hp'   => 100,
                'defeated' => false,
                'moves' => [
                    ['Brasas' => 20],
                    ['Fumo' => 10],
                ]
            ]
        ];
    }

    if ($selected === 'aqua') {
        $_SESSION['poke'][0] = [
            'Agui'=> [
                'img'=> 'agui.png',
                'maxHp' => 100,
                'hp'   => 100,
                'defeated' => false,
                'moves' => [
                    ['Hidratacao' => 20],
                    ['Gostoso' => 10],
                ]
            ]
        ];
    }

    if ($selected === 'livro') {
        $_SESSION['poke'][0] = [
            'Pe-Ene-Ele' => [
                'img'=> 'book.png',
                'maxHp'=> 100,
                'hp'   => 100,
                'defeated' => false,
                'moves' => [
                    ['Lindu' => 20],
                    ['Memorial do Convento' => 10],
                ],
            ]
        ];
    }

    header("Location: gym_1.php");
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
<h1>YOU WIN!</h1>
<h2>Choose Your  Next POKEMON</h2>

<form method="POST">
    <div class="character-container">

        <label class="char">
            <input type="radio" name="poke" value="morcela" required>
            <img src="img/morc.png" alt="Warrior">
            <div>Morc</div>
        </label>

        <label class="char">
            <input type="radio" name="poke" value="aqua">
            <img src="img/agui.png" alt="Mage">
            <div>Agui</div>
        </label>

        <label class="char">
            <input type="radio" name="poke" value="livro">
            <img src="img/book.png" alt="Archer">
            <div>Pe-Ene-Ele</div>
        </label>

    </div>

    <br>
    <button type="submit">Select</button>
</form>

</body>
</html>
