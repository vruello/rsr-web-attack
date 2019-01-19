phantom.clearCookies();

var args = require('system').args;

console.log(args);

var page = require('webpage').create();

page.open('http://localhost/RSR/connexion.php', 'POST', 'username=modo&password=mdpmodo&cookie=9008b1738b7b985650f4da47e9983bfb2522d283', function(status) {
  console.log("http://localhost/RSR/connexion.php. Status: " + status);
  page.open('http://localhost/RSR/topic.php?id_topic=2',  function(status) {
    console.log("http://localhost/RSR/topic.php?id_topic=2. Status: " + status);
    phantom.exit(0);
  });
});



