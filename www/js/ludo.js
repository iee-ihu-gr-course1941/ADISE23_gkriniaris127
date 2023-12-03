$(function() {
    draw_empty_board();
    fill_board();
});
    


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

function fill_board_by_data(data){
    var cells = {};
    for(var i=0;i<data.length;i++){
        var o = data[i];
        var id = '#square_'+ o.x + '_' + o.y;
        var im = '';
        var im1 = '';
        var im2 = '';
        var im3 = '';
        if(o.piece_num!=null && o.piece_color!=null){
            switch(o.piece_color){
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
                    im1 = '<img class="piece4x" src="images/red.png">';
                    im2 = '<img class="piece4x" src="images/blue.png">';
                    im3 = '<img class="piece4x" src="images/blue.png">';
                    console.log("gre");
                    break;
                default: '';
                break;
            }
        }
        var images = im1 + im + im2 + im3;
        //$(id).html('<div class="image-container">' + images + '</div>'); // Place images inside a container
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

