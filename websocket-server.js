// WebSocket server code
const WebSocket = require('ws');
const wss = new WebSocket.Server({ port: 80 });

wss.on('connection', (ws) => {
  ws.on('message', (message) => {
    console.log(`Received: ${message}`);
  });
});
