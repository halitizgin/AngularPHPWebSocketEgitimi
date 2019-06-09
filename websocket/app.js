const http = require('http').createServer();
const io = require('socket.io')(http);

http.listen(3000);

io.on('connection', socket => {
    console.log("Kullanıcı bağlandı!");

    socket.on('AddMovie', movie => {
        socket.broadcast.emit('AddMovie', movie);
    });

    socket.on('UpdateMovie', movie => {
        socket.broadcast.emit('UpdateMovie', movie);
    });

    socket.on('DeleteMovie', movie => {
        socket.broadcast.emit('DeleteMovie', movie);
    });

    socket.on('disconnect', () => {
        console.log("Kullanıcı çıkış yaptı!");
    });
});