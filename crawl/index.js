const express = require("express");
const exphbs = require("express-handlebars");

const app = express();
const fsp = require("fs");
const path = require('path');

app.engine("handlebars", exphbs());
app.set("view engine", "handlebars");
app.use(express.static(path.join(__dirname, "./assets")));
async function generateHomepage(req, res) {
  const data = await fsp.readFileSync("newsinfo.json", "utf8");

  if (!data) {
    throw new Error("데이터 없음");
  }
  res.render("home", {
    data: JSON.parse(data)
  });
}


app.get("/", (req, res) =>
  generateHomepage(req, res)
);
app.listen(process.env.PORT || 3000);