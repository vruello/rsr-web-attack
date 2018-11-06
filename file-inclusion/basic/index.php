<nav>
    <ul>
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="index.php?page=about.php">About</a>
        </li>
        <li>
            <a href="index.php?page=contact.php">Contact</a>
        </li>
    </ul>
</nav>

<?php

if (isset($_GET['page']))
    require($_GET['page']);
else 
    require('home.php');

