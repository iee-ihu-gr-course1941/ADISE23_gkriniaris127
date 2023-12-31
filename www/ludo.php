<?php

require_once "../lib/dbconnection.php";
require_once "../lib/board.php";
require_once "../lib/game.php";

//show_board();

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
//$request = explode('/', trim($_SERVER['SCRIPT_NAME'],'/'));
// Σε περίπτωση που τρέχουμε php –S
$input = json_decode(file_get_contents('php://input'),true);


switch ($r=array_shift($request)) {
    case 'board' :
        switch ($b=array_shift($request)) {
            case 'ghbhbh': exit;
            break;
            case null: handle_board($method);
                break;
            case 'piece': handle_piece($method, $request[0],$request[1],$input);
                break;
            case 'player': handle_player($method, $request[0],$input);
                break;
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
    case 'players': handle_player($method, $request[0],$input);
        break;         
    default:
    header("HTTP/1.1 404 Not Found");
    exit;

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


function handle_piece($method, $request,$request1,$input) {

}


function handle_player($method, $request,$input) {

}

?>