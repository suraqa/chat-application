const app = require("express")()
const http = require("http").createServer(app)
const io = require("socket.io")(http, {
    cors: {
        origin: "http://localhost:8000",
    }
})

http.listen(3000, () => {
    console.log("Server is listening on port 3000")
})


const users = {}

io.on("connection", (socket) => {

    socket.on("user_connected", userId => {
        users[userId] = socket.id
        io.emit("updateUserStatus", users)
        console.log(users);
    });

    socket.on("disconnect", () => {
        for (const uId in users) {
            if (Object.hasOwnProperty.call(users, uId)) {
                const element = users[uId];
                if(element == socket.id) {
                    delete users[uId]
                }
            }
        }
        io.emit("updateUserStatus", users)
        // console.log(users)
    })

    // console.log(socket.id)

    socket.on("sendMsgToSv", message => {
        console.log(message)
        io.emit("sendMsgToClient", message);
    });



    // socket.on("abc", a => {
    //     console.log(a)
    // })
});












// const { Emitter } = require("@socket.io/redis-emitter");
// const { createClient } = require("redis"); // not included, needs to be explicitly installed
//
// const redisClient = createClient();
// const ioEmit = new Emitter(redisClient);
//
// // // sending to all clients
// ioEmit.emit("abc", );
//
// // sending to all clients in 'room1' room
// ioEmit.to("room1").emit(/* ... */);
//
// // sending to all clients in 'room1' except those in 'room2'
// ioEmit.to("room1").except("room2").emit(/* ... */);
//
// // sending to individual socketid (private message)
// ioEmit.to(socketId).emit(/* ... */);
//
// const nsp = ioEmit.of("/admin");
//
// // sending to all clients in 'admin' namespace
// nsp.emit(/* ... */);
//
// // sending to all clients in 'admin' namespace and in 'notifications' room
// nsp.to("notifications").emit(/* ... */);






