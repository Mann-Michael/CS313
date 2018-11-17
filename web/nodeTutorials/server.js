var http = require('http');

function sayHello(request, response) {
	 console.log("Received a request for:" + request.url);
	 
	 response.write("Hello from Node");
	 response.end();
}

var server = http.createServer(sayHello);
server.listen(8888);

console.log("The server is now listening on port 5000...");