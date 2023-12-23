<?php
require_once "../lib/game.php";
function handle_user($method, $b, $input) {
    if ($method == "GET") {
        show_user($b);
    } else if ($method == "PUT") {
        set_user($b, $input);
    }
}

function show_user($b) {
    global $mysqli;
    $sql = 'select username, piece_colour from players where piece_colour=?';
    $st = $mysqli->prepare($sql);
    $st->bind_param('s', $b);
    $st->execute();
    $res = $st->get_result();
    header('Content-type: application/json');
    print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}



function set_user($b, $input) {
    if (!isset($input['username']) || $input['username'] == '') {
        header("HTTP/1.1 400 Bad Request.");
        print json_encode(['errormesg' => "No Username Given."]);
        exit;
    }

    $username = $input["username"];
    global $mysqli;

    $sql = "SELECT COUNT(*) as c FROM players WHERE piece_colour=? AND username IS NOT NULL";
    $st = $mysqli->prepare($sql);
    $st->bind_param("s", $b);
    $st->execute();
    $res = $st->get_result();
    $r = $res->fetch_all(MYSQLI_ASSOC);
   
    // if ($r[0]['c'] > 0) {
    //     header("HTTP/1.1 400 Bad Request.");
    //     print json_encode(['errormesg' => "Player $b is already set. Please select another colour."]);
    //     exit;
    // }

    $sql = 'SELECT COUNT(*) as c FROM players';
    $st2 = $mysqli->query($sql);
    $count = $st2->fetch_assoc()['c'];

    if ($count === 0) {
        $sql = 'UPDATE players SET username=?, token=md5(CONCAT(?, NOW())), last_action=NOW() WHERE piece_colour=?';
        $st3 = $mysqli->prepare($sql);
        $st3->bind_param('sss', $username, $username, $b);
        $st3->execute();
    } else {
        $sql = 'UPDATE players SET username=?, token=md5(CONCAT(?, NOW())),last_action=NOW() WHERE piece_colour=?';
        $st4 = $mysqli->prepare($sql);
        $st4->bind_param('sss', $username, $username, $b);
        $st4->execute();
    }

    update_game_status();
    $sql = 'SELECT * FROM players WHERE piece_colour=?';
    $st5 = $mysqli->prepare($sql);
    $st5->bind_param('s', $b);
    $st5->execute();
    $res = $st5->get_result();
    header('Content-type: application/json');
    print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}
?>

