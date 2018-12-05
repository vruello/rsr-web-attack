
phantom.clearCookies();

// login
var page = require('webpage').create();
// page.viewportSize = {
//   width: 1080,
//   height: 1920
// };

page.open('http://localhost/scenario1/public/?p=login', 'POST', 'username=Salmon&password=internal', function(status) {
  console.log("http://localhost/scenario1/public/?p=login. Status: " + status);
  // page.render('login.png');
});


function load() {
  page.open('http://localhost/scenario1/public/',  function(status) {
    console.log("http://localhost/scenario1/public/. Status: " + status);
    // page.render('home.png');
  });
}

setInterval(load, 5000);

