
phantom.clearCookies();

// login
var page = require('webpage').create();

page.open('http://localhost/scenario1/public/?p=login', 'POST', 'username=salmon&password=cGWhbAUmTe4JGf4J', function(status) {
  console.log("http://localhost/scenario1/public/?p=login. Status: " + status);
});


function load() {
  page.open('http://localhost/scenario1/public/',  function(status) {
    console.log("http://localhost/scenario1/public/. Status: " + status);
  });
}

setInterval(load, 5000);

