<?php
session_start();
if (!isset($_SESSION['battle'])) {

    // helper to convert various move formats into [name => power]
    function normalizeMoves($movesArr) {
        $out = [];
        foreach ($movesArr as $m) {
            if (is_array($m)) {
                if (isset($m['name']) && isset($m['power'])) {
                    $out[$m['name']] = $m['power'];
                } else {
                    foreach ($m as $k => $v) {
                        $out[$k] = $v;
                    }
                }
            }
        }
        return $out;
    }

    // build user team from choice.php session structure
    $user_team = [];
    if (!empty($_SESSION['poke']) && is_array($_SESSION['poke'])) {
        foreach ($_SESSION['poke'] as $entry) {
            // entry could be ['Name' => [details]] or ['name' => 'Name', ...]
            if (isset($entry['name'])) {
                $name = $entry['name'];
                $hp = $entry['hp'] ?? $entry['maxHp'] ?? 100;
                $img = $entry['img'] ?? '';
                $moves = normalizeMoves($entry['moves'] ?? []);
                $user_team[$name] = ['hp' => $hp, 'moves' => $moves, 'defeated' => false, 'img' => $img];
            } elseif (is_array($entry)) {
                foreach ($entry as $name => $details) {
                    $hp = $details['hp'] ?? $details['maxHp'] ?? 100;
                    $img = $details['img'] ?? '';
                    $moves = normalizeMoves($details['moves'] ?? []);
                    $user_team[$name] = ['hp' => $hp, 'moves' => $moves, 'defeated' => false, 'img' => $img];
                }
            }
        }
    }

    // fallback default team if nothing selected
    if (empty($user_team)) {
        $user_team = [
            "FIZESTEMERDA" => ["hp" => 50, "moves" => [
                "Thunderbolt" => 0,
            ], "defeated" => false],
            "BUGOUOTARIO" => ["hp" => 60, "moves" => [
                "Water Gun" => 0,
            ], "defeated" => false]
        ];
    }

    $_SESSION['battle'] = [
        "enemy_active_index" => 0,
        "user_team" => $user_team,
        "enemy_team" => [
            "Musgo do Quintal" => ["hp" => 90, "defeated" => false, "img" => "moss.png", "moves" => [
                "Verdesco" => 20,
                "Humidade" => 30,
                "Atque do Norte"=> 25,
                "Invasao Musgosa"=> 35,
            ]],
            "MariJuana" => ["hp" => 100, "defeated" => false, "img" => "420.png", "moves" => [
                "hehehehehe" => 20,
                "Ganda Canhao" => 30,
                "Enrolar bem Apertadinho"=> 25,
                "Pedrada do Caralho"=> 35,
            ]],
            "Cocas-ina" => ["hp" => 120, "defeated" => false, "img" => "cokermit.png", "moves" => [
                "Energia do Caralho" => 15,
                "Salto de Sapo" => 30,
                "Guiao de Hollywood dos Anos 80"=> 25,
                "Marretada"=> 20,
            ]],
        ],
        "user_active_index" => 0,
    ];
}
$battle = $_SESSION['battle'];

// Get active Pokémon names from indices
$userTeamArray = array_values($battle["user_team"]);
$enemyTeamArray = array_values($battle["enemy_team"]);
$userActive = array_keys($battle["user_team"])[$battle["user_active_index"]];
$enemyActive = array_keys($battle["enemy_team"])[$battle["enemy_active_index"]];


function enemyMove($pokemon) {
    $moves = $pokemon["moves"];
    $names = array_keys($moves);
    $choice = $names[array_rand($names)];
    return [$choice, $moves[$choice]];
}

function getPokemon(&$team, $name) {
    return $team[$name];
}


function isTeamDefeated($team) {
    foreach ($team as $poke) {
        if (is_array($poke) && isset($poke["defeated"]) && !$poke["defeated"]) {
            return false;
        }
    }
    return true;
}

// ----------------------
// USER ACTIONS
// ----------------------
$message = "";

if (isset($_POST['attack'])) {
    
    $move = $_POST['attack'];
    $userPoke = &$battle["user_team"][$userActive];
    $enemyPoke = &$battle["enemy_team"][$enemyActive];

    $dmg = $userPoke["moves"][$move];
    $enemyPoke["hp"] -= $dmg;
    if ($enemyPoke["hp"] < 0) $enemyPoke["hp"] = 0;

    $message = "Your {$userActive} used <b>$move</b> and dealt <b>$dmg</b> damage!<br>";

    // enemy faints
    if ($enemyPoke["hp"] <= 0) {
        $enemyPoke["defeated"] = true;
        $message .= "{$enemyActive} fainted!<br>";

        // Switch to next enemy Pokémon by index
        $battle["enemy_active_index"]++;
        if ($battle["enemy_active_index"] < count($battle["enemy_team"])) {
            $enemyActive = array_keys($battle["enemy_team"])[$battle["enemy_active_index"]];
            $message .= "Enemy sent out <b>$enemyActive</b>!";
        } else {
            $message .= "Enemy has no more Pokémon!";
            header("Location: gym_4_win.php");
            exit();
            //GO TO WIN SCREEN!!!!!!!!!!!!!!!!
        }
    } else {
        [$enemyMove, $enemyDmg] = enemyMove($battle["enemy_team"][$enemyActive]);
        $userPoke["hp"] -= $enemyDmg;
        if ($userPoke["hp"] < 0) $userPoke["hp"] = 0;

        $message .= "Enemy {$enemyActive} used <b>$enemyMove</b> and dealt <b>$enemyDmg</b> damage!<br>";

        if ($userPoke["hp"] <= 0) {
            $userPoke["defeated"] = true;
            $message .= "Your {$userActive} fainted!<br>";
            
            // Auto-switch to next available Pokémon
            $teamNames = array_keys($battle["user_team"]);
            $nextIndex = null;
            
            for ($i = 0; $i < count($teamNames); $i++) {
                $pokeName = $teamNames[$i];
                if (!$battle["user_team"][$pokeName]["defeated"] && $battle["user_team"][$pokeName]["hp"] > 0) {
                    $nextIndex = $i;
                    break;
                }
            }
            
            if ($nextIndex !== null) {
                $battle["user_active_index"] = $nextIndex;
                $userActive = $teamNames[$nextIndex];
                $message .= "You sent out <b>$userActive</b>!";
            } else {
                $message .= "You have no more Pokémon!";
            }
        }
    }
    $_SESSION['battle'] = $battle;


} elseif (isset($_POST['swap'])) {
    $swapTo = $_POST['swap'];
    $swapIndex = array_search($swapTo, array_keys($battle["user_team"]));
    if ($swapIndex !== false && $battle["user_team"][$swapTo]["hp"] > 0 && !$battle["user_team"][$swapTo]["defeated"]) {
        $battle["user_active_index"] = $swapIndex;
        $message = "You swapped to <b>$swapTo</b>!";
        $_SESSION['battle'] = $battle;
    } else {
        $message = "That Pokémon has fainted!";
    }
}

// ----------------------
// CHECK WIN/LOSS
// ----------------------
if (isTeamDefeated($battle["enemy_team"])) {
    echo "<h1>You Win!</h1>";
    session_destroy();
    exit;
}

if (isTeamDefeated($battle["user_team"])) {
    echo "<h1>You Lose!</h1>";
    session_destroy();
    exit;
}

// ----------------------
// CURRENT BATTLE STATE
/* ----------------------
echo "<div style='background: #f0f0f0; padding: 10px; margin: 10px 0; font-family: monospace; border: 1px solid #ccc;'>";
echo "<strong>Enemy Team Status:</strong><br>";
foreach ($battle["enemy_team"] as $name => $poke) {
    $status = $poke["defeated"] ? "FAINTED" : "ALIVE";
    $hpBar = str_repeat("█", max(0, intval($poke["hp"] / 5))) . str_repeat("░", max(0, intval((100 - $poke["hp"]) / 5)));
    echo "{$name}: {$poke['hp']}/100 HP [$hpBar] - {$status}<br>";
}
echo "</div>";
*/


// ----------------------
// CURRENT BATTLE STATE
// ----------------------
$userActive = array_keys($battle["user_team"])[$battle["user_active_index"]];
$enemyActive = array_keys($battle["enemy_team"])[$battle["enemy_active_index"]];
$userPoke = $battle["user_team"][$userActive];
$enemyPoke = $battle["enemy_team"][$enemyActive];
?>
<!DOCTYPE html>
<html>
<head>
<title>POKEMORCELA - GYM 2</title>
<link href="../css/basic.css" rel="stylesheet">
<link href="../css/gym.css" rel="stylesheet">
</head>
<body>

<h1> GYM 4  - Rainbow BADGE </h1>

<div class="box">
    <h2><?= $enemyActive ?> <br> HP: <?= $enemyPoke["hp"] ?></h2>
    <?php if (isset($enemyPoke["img"])): ?>
        <img src="img/<?= $enemyPoke["img"] ?>" alt="<?= $enemyActive ?>" style="width: 400px; height: 400px;">
    <?php endif; ?>
</div>

<div class="box">
    <h2><?= $userActive ?> <br> HP: <?= $userPoke["hp"] ?></h2>
    <?php if (isset($userPoke["img"])): ?>
        <img src="img/<?= $userPoke["img"] ?>" alt="<?= $userActive ?>" style="width: 400px; height: 400px;">
    <?php endif; ?>
</div>



<div class="box">
    <h3>Battle Log:</h3>
    <p><?= $message ?></p>
</div>

<!-- Attack Buttons -->
<div class="box">
    <h3>Select an Attack</h3>
    <form method="POST">
        <?php foreach ($userPoke["moves"] as $move => $dmg): ?>
            <button type="submit" name="attack" value="<?= $move ?>">
                <?= $move ?> <i><?= $dmg ?> dmg</i>
            </button>
        <?php endforeach; ?>
    </form>
</div>

<!-- Swap Pokémon -->
<div class="box">
    <h3>Swap Pokémon</h3>
    <form method="POST">
        <?php foreach ($battle["user_team"] as $name => $poke): ?>
            <?php if ($poke["hp"] > 0 && $name !== $userActive): ?>
                <button type="submit" name="swap" value="<?= $name ?>">
                    Switch to <?= $name ?> (HP: <?= $poke["hp"] ?>)
                </button>
            <?php endif; ?>
        <?php endforeach; ?>
    </form>
</div>

</body>
</html>
