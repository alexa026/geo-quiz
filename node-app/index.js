const io = require('socket.io')(3000),
    redis = require('redis'),
    questionSubscriber = redis.createClient(),
    locationSubscriber = redis.createClient();

questionSubscriber.on('message', function (channel, data) {
    data = JSON.parse(data);
    io.emit('new Question', data.data);
});

questionSubscriber.subscribe('question');

locationSubscriber.on('message', function (channel, data) {
    data = JSON.parse(data);
    io.emit('new Location', data.data);
});

locationSubscriber.subscribe('location');