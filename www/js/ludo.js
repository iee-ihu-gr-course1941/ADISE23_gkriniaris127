$(function() {
    $('#resul').hide();
    $('#ludo_reset').hide();
    $('#dice').hide();
    $('#Notmove_div').hide();
    $('#move_div').hide();
    $('#move_div2').hide();
    $('#yesno').hide();
    setTimeout(function() {game_status_update();}, 15000);
    draw_empty_board();
    fill_board();
    $('#ludo_login').click(login_to_game);
    $('#do_move').click(do_move);
    $('#rollDice').click(rollDice);
    $('input[name="yesno"]').click(getYesNo)
    $('#resetButton').click(reset);
});

let selectedValue = null;
var countdice=0;
let no_pieces = null;
let turn = null;
let diceResult;
console.log("countdice " + countdice);

function do_move(){
    var s = $('#the_move').val();
    var re = $('#result').val();
}

function start(){
    $('#ludo_reset').hide();
}

function dice() {
    diceResult = Math.floor(Math.random() * 6) + 1;
    document.getElementById("result").innerHTML = "Έφερες " + diceResult;
}

function rollDice() {
    dice();
    $.ajax({
        type: "POST",
        url: "ludo.php/dice/" + diceResult, 
        data: { diceResult: diceResult }, 
        success: check_pieces,
        error: function(xhr, status, error) {
            console.log("AJAX error:", error); 
        }
    });
}

function check_pieces(data){
    turn = data.piece_no;
    countdice++;
    var piece = data.piece_no;
    var color = data.color;
    var posi = data.position;
    console.log("game_status.p_turn "+game_status.p_turn);
    console.log("turn "+turn);

    if(game_status.p_turn == color){
        if (diceResult != 6 && piece == null && countdice == 1){
            $('#Notmove_div').show(500);
            $('#Notmove_div').hide(3000);
            
            pturn(color);
            
            countdice=0;
        }else if (diceResult == 6 && countdice == 1 && posi == 57) {
            piece++;
            console.log("countdice ++++" + countdice);
            console.log("tmp"+ piecetmp);
            console.log("piece "+ piece);
            $('#move_div').show();
            $('#move_div').hide(3000);
            $.ajax({
                type: "PUT",
                url: "ludo.php/move/first/"+piece, 
                success: fill_board,
                error: function(xhr, status, error) {
                    console.log("AJAX error:", error); 
                }
            });
        }else if (piece==null && diceResult == 6 && countdice == 1){
            console.log("countdice " + countdice);
            $('#move_div').show();
            $('#move_div').hide(3000);
            $.ajax({
                type: "PUT",
                url: "ludo.php/move/first/1", 
                success: fill_board,
                error: function(xhr, status, error) {
                    console.log("AJAX error:", error); 
                }
            });
        }
        else if (countdice == 2) {
            console.log("countdice " + countdice);
            console.log("piece dice 2  " + piece);
            $.ajax({
                type: "PUT",
                url: "ludo.php/move/"+piece, 
                success:function(response) {
                    var result = response.data;
                    if (result == 1) {
                        $('#resul').show(3000);
                        reset();
                    }
                    fill_board();},
                error: function(xhr, status, error) {
                    console.log("AJAX error:", error); 
                }
            });
            countdice=0;
            pturn(color);
        } else if (diceResult != 6 && piece != null && countdice == 1){
            $.ajax({
                type: "PUT",
                url: "ludo.php/move/"+piece, 
                success:function(response) {
                    var result = response.data;
                    if (result == 1) {
                        $('#resul').show(3000);
                        reset();
                    }
                    fill_board();},
                error: function(xhr, status, error) {
                    console.log("AJAX error:", error); 
                }
            });
            countdice=0;
            pturn(color);
        } else if (diceResult == 6 && piece != null ){
            $.ajax({
                type: "PUT",
                url: "ludo.php/move/"+piece, 
                success:function(response) {
                    var result = response.data;
                    if (result == 1) {
                        $('#resul').show(3000);
                        reset();
                    }
                    fill_board();},
                error: function(xhr, status, error) {
                    console.log("AJAX error:", error); 
                }
            });
            countdice=0;
            pturn(color);
        }
    }
}

function pturn(color){
    setTimeout(function() {
        document.getElementById("result").innerHTML = "";
      }, 2000);
    
    $.ajax({
        type: "POST",
        url: "ludo.php/turn/" + color, 
        data:  {color: color},  
        error: function(xhr, status, error) {
            console.log("AJAX error:", error); 
        }
    });
}

function getYesNo() {
    var radios = document.getElementsByName('yesno');
    var yesno = null;
    
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            yesno = radios[i].value;
            break;
        }
    }

    return yesno;
}

function yesno(yesnos){
    // if (yesnos== 'yes'){

    // }else if (yesnos== 'no'){

    // }
}

function draw_empty_board() {
    var t = '<table id="ludo_table">';
    for (var i = 15; i > 0; i--) {
        t += '<tr>';
        for (var j = 1; j < 16; j++) {
            t += '<td class="ludo_square" id="square_' + j + '_' + i + '">' + j + ',' + i + '</td>';
        }
        t += '</tr>';
    }
    t += '</table>';
    $('#ludo_board').html(t);
}

function fill_board() {
    $.ajax(
        {url: "ludo.php/board",
        success: fill_board_by_data,
        error: function(xhr, status, error) {
            console.log("AJAX error:", error); 
        }
        }
    );
}

function reset() {
    $.ajax(
        {url: "ludo.php/board",
        method: 'post',
        success: fill_board_by_data,
        error: function(xhr, status, error) {
            console.log("AJAX error:", error); 
        }
        }
    );

    location.reload();
}

function fill_board_by_data(data){
    var cells = {};
    for(var i=0;i<data.length;i++){
        var o = data[i];
        var id = '#square_'+ o.x + '_' + o.y;
        var im = '';
        if(o.piece_num!=null){
            switch(o.piece_colour){
                case 'Y':
                    im = '<img class="piece4x" src="images/yellow.png">';
                    break;
                case 'R': 
                    im = '<img class="piece4x" src="images/red.png">';
                    break;
                case 'B': 
                    im = '<img class="piece4x" src="images/blue.png">';
                    break;
                case 'G': 
                    im = '<img class="piece4x" src="images/green.png">';
                    break;
                default: '';
                break;
            }
        }
        $(id).addClass(o.b_color + '_square').html(im);
        cells[id] = true;
    }

    for (var i = 1; i <= 15; i++) {
        for (var j = 1; j <= 15; j++) {
            var id = '#square_' + j + '_' + i;

            if (!cells[id]) {
                $(id).addClass('empty_square').empty();
            }
        }
    }
}

function login_to_game() {
    $('#resul').hide();
    if ( $('#username').val()=='') {
        alert('You have to set a username');
        return;
    }

    var p_colour = getSelectedColor();
    
    if (!p_colour) {
        alert('Please select a color');
        return;
    }

    $.ajax({url: "ludo.php/players/"+p_colour,
            method: 'PUT',
            dataType: "json",
            contentType: 'application/json',
            data: JSON.stringify( {
                username: $('#username').val(), 
                piece_colour: p_colour}),
            success: login_result,
            error: login_error});
}

function getSelectedColor() {
    var radios = document.getElementsByName('colour');
    var selectedColor = '';
    
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            selectedColor = radios[i].value;
            break;
        }
    }

    return selectedColor;
}

let game_status=[];
let me =[];

function login_result(data) {
    me =data[0];
    $('#selectors').hide();
    $('#ludo_reset').show();
    update_info();
    game_start();
    game_status_update();
}

function login_error(data,y,z,c) {
    console.log(data);
    console.log(data.responseJSON);
    var x = data.responseJSON;
    alert(x.errormesg);
    }
    
function game_start() {
    if (game_status.status == 'started' && me.piece_colour == game_status.p_turn){
        $('#dice').show(1000);
    }
}

function update_info() {
    $('#game_info').html("I am Player: <b>"+ me.piece_colour+"</b><br>My name is <b>"+me.username+"</b><br>Token= <b>"+me.token+"</b><br>Game state: <b>"+game_status.status+"</b>,<br> <b>"+game_status.p_turn+"</b> must play now.");
}

function game_status_update() {
    $.ajax({url: "ludo.php/status/", success: update_status});
}

function update_status(data){
    game_status=data[0];
    if (!($('#selectors').is(':visible'))){
        update_info();
    }
    fill_board()
    
    if(game_status.p_turn==me.piece_colour && me.piece_colour!=null){
        //x=0;
        $('#dice').show(1000);
        setTimeout(function() {game_status_update();}, 4000);
    }else {
        $('#dice').hide(1000);
        setTimeout(function() {game_status_update();}, 4000);
    }
}