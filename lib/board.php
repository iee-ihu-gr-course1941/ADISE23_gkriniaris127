<?php

function show_board() {
    global $mysqli;

    $sql = "SELECT * FROM board";
    $st = $mysqli -> prepare($sql);

    $st -> execute();
    $res = $st -> get_result();

    $data = $res->fetch_all(MYSQLI_ASSOC);
    header('Content-type: application/json');
    print json_encode($data, JSON_PRETTY_PRINT);

}

function reset_board() {
    global $mysqli;
    $sql = 'call clean_board()';
    $mysqli -> query($sql);

    $sql1 = 'call clean_players()';
    $mysqli -> query($sql1);

    $sql2 = 'call clean_status()';
    $mysqli -> query($sql2);
    show_board();
}

?>