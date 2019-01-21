
phantom.clearCookies();

// login
var page = require('webpage').create();

page.open('http://localhost/index.php', 'POST', 'login=bob&password=q-5%5D%2Bx%28G2%28TzVr%7Bs', function(status) {
  console.log("http://localhost/index.php. Status: " + status);
});


function load() {
  page.open('http://localhost/cyberoom.php',  function(status) {
    console.log("http://localhost/cyberoom.php. Status: " + status);
  });
}

setInterval(load, 5000);


