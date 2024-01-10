<?php


function show_status() {
    global $mysqli;

    $sql = "SELECT * FROM game_status";
    $st = $mysqli -> prepare($sql);

    $st -> execute();
    $res = $st -> get_result();

    $data = $res->fetch_all(MYSQLI_ASSOC);
    header('Content-type: application/json');
    print json_encode($data, JSON_PRETTY_PRINT);

}



function update_game_status() {
    global $mysqli;

    // Fetch current game status
    $sql = 'SELECT * FROM game_status';
    $st = $mysqli->prepare($sql);
    $st->execute();
    $res = $st->get_result();
    $status = $res->fetch_assoc();

    // Check for aborted players
    $st_aborted = $mysqli->prepare('SELECT COUNT(*) as aborted FROM players WHERE last_action < (NOW() - INTERVAL 5 MINUTE)');
    $st_aborted->execute();
    $res_aborted = $st_aborted->get_result();
    $aborted = $res_aborted->fetch_assoc()['aborted'];

    if ($aborted > 0) {
        $sql_aborted = 'UPDATE players SET username = null, token = null WHERE last_action < (NOW() - INTERVAL 5 MINUTE)';
        $st_update_aborted = $mysqli->prepare($sql_aborted);
        $st_update_aborted->execute();

        if ($status['status'] == 'started') {
            $new_status = 'aborted';
        }
    }

    // Count active players
    $st_active_players = $mysqli->prepare('SELECT COUNT(*) as c FROM players WHERE username IS NOT NULL');
    $st_active_players->execute();
    $res_active_players = $st_active_players->get_result();
    $active_players = $res_active_players->fetch_assoc()['c'];

    // Determine new status and turn
    $new_status = null;
    $new_turn = null;

    switch ($active_players) {
        case 0:
            $new_status = 'not active';
            break;
        case 1:
            $new_status = 'initialized';
            break;
        case 2:
            $new_status = 'started';
            if ($new_turn == null) {
                $new_turn = 'R';
            }
            break;
    }

    // Update game status
    $sql_update = 'UPDATE game_status SET status=?, p_turn=?, last_change=NOW()';
    $st_update = $mysqli->prepare($sql_update);
    $st_update->bind_param('ss', $new_status, $new_turn);
    $st_update->execute();
}
?>