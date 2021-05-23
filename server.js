const { data } = require("jquery");

const Express = require("express")();
const Http = require("http").Server(Express);
const Socketio = require("socket.io")(Http);

var turn = {
    players:[0, 0]
};

Socketio.onconnection("connection", socket => {
    socket.emit("turn", turn);
    socket.on("move", data =>{
        switch(data){
            case "attack":
                turn.players[data]+=1
                socket.emit("turn", turn);
        }
    })
});

Http.listen(3000, () =>{
    console.log("Listening at :3000...")
});