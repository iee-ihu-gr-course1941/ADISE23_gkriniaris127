<?php

require_once "../lib/dbconnection.php";
require_once "../lib/board.php";
require_once "../lib/game.php";
require_once "../lib/users.php";

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
            case 'piece': handle_piece($method, $request[0],$request[1],$input);
                break;
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
    case 'dice': handle_dice($method, $request,$input) ;
        break;     
    default:
    header("HTTP/1.1 404 Not Found");
    exit;

}

function handle_dice($method, $request,$input) {
    if($method== "POST"){
        global $mysqli;
        $sql = 'SELECT p_turn FROM game_status';
        $result = $mysqli->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            $currentPlayer = $row['p_turn'];
            if ($currentPlayer === $playerToken) { // Προσαρμόστε τη μεταβλητή που περιέχει το token του παίκτη
                // Ο παίκτης έχει τη σειρά του να ρίξει το ζάρι
                $diceResult = mt_rand(1, 6); // Ρίξτε το ζάρι
        
                // Ανανεώστε τον πίνακα game_status με τη σειρά του επόμενου παίκτη
                // Π.χ., αλλάξτε την τιμή της στήλης p_turn στον επόμενο παίκτη
                $nextPlayer = ($currentPlayer === 'player1') ? 'player2' : 'player1';
                $updateSql = "UPDATE game_status SET p_turn = '$nextPlayer'";
                $updateResult = $mysqli->query($updateSql);
        
                if ($updateResult) {
                    // Επιτυχής ενημέρωση του game_status
                    // Επιστρέψτε το αποτέλεσμα του ζαριού στον παίκτη με JSON
                    echo json_encode(['diceResult' => $diceResult]);
                } else {
                    // Σφάλμα κατά την ενημέρωση του game_status
                    http_response_code(500);
                    echo json_encode(['error' => 'Failed to update game status']);
                }
            } else {
                // Ο παίκτης δεν έχει σειρά, οπότε δεν μπορεί να ρίξει το ζάρι
                http_response_code(403); // Κωδικός απαγόρευσης πρόσβασης
                echo json_encode(['error' => 'Not your turn to roll the dice']);
            }
        } else {
            // Σφάλμα κατά την ανάκτηση του game_status
            http_response_code(500);
            echo json_encode(['error' => 'Failed to retrieve game status']);
        }
    }
    
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


function handle_piece($method, $x, $y, $input) {
    if ($method == 'GET') {
        show_piece($x, $y);
    }
}


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
