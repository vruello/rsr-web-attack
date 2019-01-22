function loginAndBrowse() {

        phantom.clearCookies();

        var page = require('webpage').create();
          
        page.open('http://localhost/?p=login', 'POST', 'username=salmon&password=cGWhbAUmTe4JGf4J', function(status) {
                console.log("http://localhost/?p=login. Status: " + status);
                page.open('http://localhost/',  function(status) {
                        console.log("http://localhost/. Status: " + status);
                });
        });

}

setInterval(loginAndBrowse, 5000);
