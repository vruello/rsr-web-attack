var phantom = require('phantom');

phantom.clearCookies();

var page = require('webpage').create();

page.open('http://127.0.0.1:5000/login', 'POST', 'login=Bob&password=2Y2k6Aet&factor=1234', function(status) {
  console.log("http://127.0.0.1:5000/login : Status : " + status);
});


function load() {
  page.open('http://127.0.0.1:5000/withdraw',  function(status) {
    console.log("http://127.0.0.1:5000/withdraw : " + status);
  });
}

setInterval(load, 5000);