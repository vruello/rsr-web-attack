
phantom.clearCookies();

// login
var page = require('webpage').create();

page.open('http://localhost/index.php', 'POST', 'login=alice&password=tm%29Z5%2BHBks%7D%22df%7B%60', function(status) {
  console.log("http://localhost/index.php. Status: " + status);
});


function load() {
  page.open('http://localhost/cyberoom.php',  function(status) {
    console.log("http://localhost/cyberoom.php. Status: " + status);
  });
}

setInterval(load, 5000);


