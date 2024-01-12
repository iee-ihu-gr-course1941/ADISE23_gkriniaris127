<?php

require_once "../lib/dbconnection.php";
require_once "../lib/board.php";
require_once "../lib/game.php";
require_once "../lib/users.php";
// require_once "../lib/websocket_server.php";

//show_board();

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
//$request = explode('/', trim($_SERVER['SCRIPT_NAME'],'/'));
// Σε περίπτωση που τρέχουμε php –S
$input = json_decode(file_get_contents('php://input'),true);


switch ($r=array_shift($request)) {
    case 'board' :
        switch ($b=array_shift($request)) {
            case 'FSSDF': exit;
            case null: handle_board($method);
                break;
            // case 'piece': handle_piece($method, $request[0],$request[1],$input);
            //     break;
            //case 'player': handle_player($method, $request[0],$input);
                //break;
            default: header("HTTP/1.1 404 Not Found");
                break;
        }
        break;
    case 'welcome' : handle_welcome($method);
        break;
    case 'status': 
        if (sizeof($request)== 0) {handle_status($method);}
        else {header("HTTP/1.1 NotFound");}
        break; 
    case 'players': handle_player($method, $request,$input);
        break;
    case 'dice': 
        //$c=array_shift($request);
        //if($c==null){
            handle_dice($method, $request);
        //}
        //handle_dice($method, $request) ;
        break;
    case 'move': 
        switch ($b=array_shift($request)) {
            case 'first': move_first($method , $request);
            break;
            case '1': 
            case '2':
            case '3':
            case '4': move_more($method, $request, $b);
            break;
        }
        
        break;
    case 'turn': change_turn($method, $request);
        break;
    default:
    header("HTTP/1.1 404 Not Found");
    exit;

}


function change_turn($method, $p){
    $nextTurn=null;
    if($method=="POST"){
        switch ($b=array_shift($p)) {
            case 'R': $nextTurn='B';
            break;
            case 'B' : $nextTurn='R';
        }
    }

    global $mysqli;
    $updateSql1 = "UPDATE game_status SET p_turn = '$nextTurn'";
    $updateResult = $mysqli->query($updateSql1);

}

function move_piece($method, $p){
    if($method=="POST"){
        switch ($b=array_shift($p)) {
            case '1': 
        }
    }
}

// function handle_pieces($method, $request){
//     if($method== "GET"){
//         global $mysqli;
//         $sql ="select players.player_no as no, players.piece_colour as color from players join game_status on players.piece_colour = game_status.p_turn where players.piece_colour = game_status.p_turn";
//         $result = $mysqli->query($sql);
//         $piece= '';
//         $color ='';
//         while($row = $result->fetch_assoc()) {
//             $piece= $row["no"];
//             $color = $row["color"];
//         }
//     }
// }

function handle_dice($method, $request) {
    global $mysqli;
    $sql ="select players.player_no as no, players.piece_colour as color from players join game_status on 
    players.piece_colour = game_status.p_turn where players.piece_colour = game_status.p_turn";   
    $result = $mysqli->query($sql);

    $piece= '';
    $color ='';
    $position = '';

    while($row = $result->fetch_assoc()) {
        $piece= $row["no"];
        $color = $row["color"];
    }

    if ($piece > 1){
        $sql3 = "SELECT position from board where piece_colour = '$color' and piece_num = $piece - 1";
        $st1 = $mysqli -> query($sql3);
        
        if ($st1) {
            $data1 = $st1->fetch_assoc();
            $position = $data1["position"];
        }
        
    }
    
    $combinedData1 = array(
        'color' => $color,
        'piece_no' => $piece,
        'position' => $position
    );
    
    if($method== "POST"){
        global $mysqli;
        $sql = 'SELECT game_status.p_turn as p_turn, players.token as token FROM game_status join players on game_status.p_turn = players.piece_colour';
        $result = $mysqli->query($sql);
        

        if ($result) {
            $row = $result->fetch_assoc();
            $currentPlayer = $row['p_turn'];
            $playerToken = $row['token'];
            $diceResult=array_shift($request);
            
            if($row['p_turn'] == 'R'){
                $nextPlayer = 'B';
            }else if ($row['p_turn'] == 'B') {
                $nextPlayer = 'R';
            }
            
            $updateSql1 = "UPDATE game_status SET dice_num = '$diceResult'";
            $updateResult = $mysqli->query($updateSql1);

            
            
            header('Content-type: application/json');
            print json_encode($combinedData1, JSON_PRETTY_PRINT);
           
            
        } else {
            // Σφάλμα κατά την ανάκτηση του game_status
            http_response_code(500);
            echo json_encode(['error' => 'Failed to retrieve game status']);
        }
    
    }
    
}

function move_first($method , $request){
    $pieceno=array_shift($request);
    
    if($method=="PUT"){
        global $mysqli;
        $sql ="select p_turn as color from game_status";
        $result = $mysqli->query($sql);
        $piece= '';
        $color ='';
        while($row = $result->fetch_assoc()) {
            $color = $row["color"];
        }
        $colorx='';
        $colory='';
        if($color=='R'){
            $colorx='redX';
            $colory='redY';
        }else if($color=='B'){
            $colorx='blueX';
            $colory='blueY';
        }

        
        if($pieceno == 1){
            $position=61;
        } else if ($pieceno == 2){
            $position=60;
        } else if ($pieceno == 3){
            $position=59;
        } else if ($pieceno == 4){
            $position=58;
        }

        $sql3 = "SELECT $colorx as x, $colory as y from positions WHERE position=$position";
        $st1 = $mysqli -> query($sql3);
        $data1 = $st1->fetch_all(MYSQLI_ASSOC);

        $sql4 ="SELECT $colorx as x, $colory as y from positions WHERE position=1";
        $st2 = $mysqli -> query($sql4);
        $data2 = $st2->fetch_all(MYSQLI_ASSOC);

        
        $combinedData = array(
            'current' => $data1,
            'next' => $data2,
            'color' => $color,
            'piece_no' => $pieceno
        );

        $cx = $data1[0]['x']; // Accessing the 'x' value from the first row in $data2
        $cy = $data1[0]['y'];

        $nx = $data2[0]['x']; // Accessing the 'x' value from the first row in $data2
        $ny = $data2[0]['y'];
        
        header('Content-type: application/json');
        print json_encode($combinedData, JSON_PRETTY_PRINT);

        $updateSql = "UPDATE board SET position = 1, piece_num=$pieceno, piece_colour='$color' where x=$nx and y=$ny";
        $updateResult = $mysqli->query($updateSql);

        $updateSql1 = "UPDATE board SET position = null, piece_num=null, piece_colour=null where x=$cx and y=$cy";
        $updateResult = $mysqli->query($updateSql1);

        $updateSql1 = "UPDATE players SET player_no = $pieceno where piece_colour= '$color'";
        $updateResult = $mysqli->query($updateSql1);

       
    }
}

function move_more($method , $request, $b){
    

    global $mysqli;
    $sql ="select players.player_no as no, players.piece_colour as color from players join game_status on players.piece_colour = game_status.p_turn where players.piece_colour = game_status.p_turn";
    $result = $mysqli->query($sql);
    $piece= '';
    $color ='';
    while($row = $result->fetch_assoc()) {
        $piece= $row["no"];
        $color = $row["color"];
    }
    $colorx='';
    $colory='';
    if($color=='R'){
        $colorx='redX';
        $colory='redY';
    }else if($color=='B'){
        $colorx='blueX';
        $colory='blueY';
    }

    if($method=="PUT"){
        
            $sql3 = "SELECT dice_num as dice from game_status";
            $st1 = $mysqli -> query($sql3);
            $data = $st1->fetch_all(MYSQLI_ASSOC);

            $sql2 = "SELECT x, y, position from board where piece_colour= '".$color."' and piece_num = ".$b;
            $st1 = $mysqli -> query($sql2);
            $data1 = $st1->fetch_all(MYSQLI_ASSOC);

            $dice = $data[0]['dice'];
            $posi = $data1[0]['position'];
            $movement= $dice + $posi;
            if ($movement <= 57) {
                $sql4 ="SELECT ".$colorx." as x, ".$colory." as y from positions WHERE position= ".$movement."";
                $st2 = $mysqli -> query($sql4);
                $data2 = $st2->fetch_all(MYSQLI_ASSOC);

                $cx = $data1[0]['x']; // Accessing the 'x' value from the first row in $data2
                $cy = $data1[0]['y'];

                $nx = $data2[0]['x']; // Accessing the 'x' value from the first row in $data2
                $ny = $data2[0]['y'];
                

                $updateSql = "UPDATE board SET position = $movement, piece_num=$b, piece_colour='$color' where x=$nx and y=$ny";
                $updateResult = $mysqli->query($updateSql);

                $updateSql1 = "UPDATE board SET position = null, piece_num=null, piece_colour=null where x=$cx and y=$cy";
                $updateResult = $mysqli->query($updateSql1);

                if ($movement == 57){
                    $b++;
                    $updateSql2 = "UPDATE players SET player_no =$b  where piece_colour='$color'";
                    $updateResult = $mysqli->query($updateSql2);
                }


                $sql ="SELECT count(position) FROM board WHERE piece_colour = '$color'";
                $st2 = $mysqli -> query($sql);
                $data = $st2->fetch_all(MYSQLI_ASSOC);

                $winner = 0;
                if ($data[0] == 1) {
                    $winner = 1;
                    $updateSql2 = "UPDATE game_status SET result = '$color'";
                    $updateResult = $mysqli->query($updateSql2);
                }

                header('Content-type: application/json');
                print json_encode($winner, JSON_PRETTY_PRINT);
            
        }
    }
}



function play_the_dice($player, $dice) {
    global $mysqli;

    $sql = "SELECT board.x, board.y, board.piece_colour, game_status.dice_num from board join game_status on board.piece_colour = game_status.p_turn where board.piece_colour='$player'";
    $st = $mysqli -> prepare($sql);

    $st -> execute();
    $res = $st -> get_result();

    $data = $res->fetch_all(MYSQLI_ASSOC);
    header('Content-type: application/json');
    print json_encode($data, JSON_PRETTY_PRINT);
}

function handle_board($method) {
    if ($method == 'GET') {
        
        show_board();
        
    } else if ($method == 'POST') {
        reset_board();
    } else {
        header('HTTP/1.1 405 Method Not Allowed');
    }
}

function handle_status($method) {
    if($method == 'GET') {
        show_status();
    } else {
        header('HTTP/1.1 405 Method Not Allowed');
    }
}


function handle_welcome($method) {

}


// function handle_piece($method, $x, $y, $input) {
//     if ($method == 'GET') {
//         show_piece($x, $y);
//     }
// }


function handle_player($method, $p, $input) {
    switch ($b=array_shift($p)) {
        // case '': 
        // case null: 
        //     if ($method == 'GET') {
        //         show_user($method);
        //     } else {
        //         header("HTTP/1.1 400 Bad Request");
        //         print json_encode(['errormesg'=>"Method $method not allowed here."]);
        //     }
        // break;
        
        case 'B': 
        case 'R':
         handle_user($method, $b, $input);
        break;
        default: header("HTTP/1.1 404 Not Found");
            print json_encode(['errormesg'=>"Player $b not found."]);
        break;
    }
}


?>
