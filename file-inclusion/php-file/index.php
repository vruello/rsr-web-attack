<nav>
    <ul>
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="index.php?page=login">Login</a>
        </li>
    </ul>
</nav>

<?php

if (isset($_GET['page']))
    require($_GET['page'] . '.php');
else 
    require('home.php');

