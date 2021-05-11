const express = require("express");
const cors = require("cors");

const app = express();
const PORT = process.env.PORT || 3000;

app.use(cors());

app.options("*", (req, res, next) => {
    res.header('Access-Control-Allow-Origin', "*")
    res.header('Access-Control-Allow-Methods', 'GET,PUT,POST,OPTIONS');
    res.header('Access-Control-Allow-Headers', 'Authorization, Content-Length, X-Requested-With');
    res.send(200);
});

app.use(express.json());

app.use(express.urlencoded({ extended: false }));

app.use((req, res, next) => {
    console.log(`${req.method} ${req.path} - ${req.ip}`);
    next();
});

app.use(express.static('public'));
app.use(express.static('css'));

const jsonRoutes = require("./routes/json");
cont echoAllRoutes = require("./routes/echo-all");

app.use

app.get('/', (req, res) => {
    res.sendFile(__dirname + "index.php");
});

app.listen(PORT, () => console.log(`Listening on ${PORT}`));