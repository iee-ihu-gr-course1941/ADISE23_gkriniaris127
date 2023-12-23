$(function() {
    $('#ludo_reset').hide();
    $('#dice').hide();
    draw_empty_board();
    fill_board();
    $('#ludo_reset').click(reset_board);
    $('#ludo_login').click(login_to_game);
    $('#do_move').click(do_move);
});


function do_move(){
    var s = $('#the_move').val();
    var re = $('#result').val();
}


function start(){
    $('#ludo_reset').hide();
}

function rollDice() {
    // Generate a random number between 1 and 6 (for a standard six-sided die)
    var diceResult = Math.floor(Math.random() * 6) + 1;

    // Display the result
    document.getElementById("result").innerText = "You rolled a " + diceResult;

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
            console.log("AJAX error:", error); // Log any AJAX errors
        }
        }
    );
}

function reset_board() {
    $.ajax(
        {url: "ludo.php/board",
        method: 'post',
        success: fill_board_by_data,
        error: function(xhr, status, error) {
            console.log("AJAX error:", error); // Log any AJAX errors
        }
        }
    );
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
                    im = '<img class="piece1x" src="images/yellow.png">';
                    console.log("yel");
                    break;
                case 'R': 
                    im = '<img class="piece1x" src="images/red.png">';
                    console.log("red");
                    break;
                case 'B': 
                    im = '<img class="piece1x" src="images/blue.png">';
                    console.log("bl");
                    break;
                case 'G': 
                    im = '<img class="piece1x" src="images/green.png">';
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
    if ( $('#username').val()=='') {
        alert('You have to set a username');
        return;
    }



    var p_colour = getSelectedColor();
    console.log(p_colour);
    if (!p_colour) {
        alert('Please select a color');
        return;
    }


    console.log(p_colour);
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
    console.log(radios.length);
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            selectedColor = radios[i].value;
            break;
        }
    }

    return selectedColor;
}

game_status={};

function login_result(data) {
    me =data[0];
    $('#selectors').hide();
    $('#ludo_reset').show();
    update_info();
    //game_start();
    game_status_update();
}

function login_error(data,y,z,c) {
    console.log(data);
    console.log(data.responseJSON);
    var x = data.responseJSON;
    alert(x.errormesg);
    }
    

// function login_error(data, y, z, c) {
//     if (data && data.responseJSON && data.responseJSON.errormesg) {
//         var errorMessage = data.responseJSON.errormesg;
//         alert(errorMessage);
//     } else {
//         // Handle the case where the error message is not available
//         console.error("Error message not found in response:", data);
//         alert("An error occurred. Please try again.");
//     }
// }


function update_info() {
    $('#game_info').html("I am Player: <b>"+ me.piece_colour+"</b><br>My name is <b>"+me.username+"</b><br>Token= <b>"+me.token+"</b><br>Game state: <b>"+game_status.status+"</b>,<br> <b>"+game_status.p_turn+"</b> must play now.");
}

function game_status_update() {
    $.ajax({url: "ludo.php/status/", success: update_status});
}

function update_status(data){
    game_status=data[0];
    update_info();
    if(game_status.p_turn==me.piece_colour && me.piece_colour!=null){
        x=0;
        $('#dice').show(1000);
        setTimeout(function() {game_status_update();}, 15000000);
    }else {
        $('#dice').hide(1000);
        setTimeout(function() {game_status_update();}, 4000000);
    }
}
    
