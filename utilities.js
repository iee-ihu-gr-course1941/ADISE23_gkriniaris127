let user = '';
let board = [];
let gameStatus = {};
// prompt -> red

async function checkGameSatus() {
    const response = await fetch('localhost/my/ludo.php/board');
    const data = response.json();
    gameStatus = data.gameStatus;
    board = data.board;
}

setInterval(checkGameSatus, 500);

// ---

// 1 get token by submitting username
// 2 polling request for game status and players -> players[0].token
// 3 make a move and update to server