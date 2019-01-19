
<?php
$pagetitle="index";
include "header.php";
?>

<div class="jumbotron">
    <h2>Bienvenue !</h2>
    <p>Installe toi, mets toi à l'aise, et amuse toi !</p>
</div>

<div class="row">
    <div class="col-sm-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="images/carousel1.png" alt="Team GCC 2017">
                    <div class="carousel-caption">
                        <p>Team sécurité WEB</p>
                    </div>
                </div>

                <div class="item">
                    <img src="images/carousel2.png" alt="Team GCC 2017">
                    <div class="carousel-caption">
                        <p>Apprenez à sécuriser vos sites web!</p>
                    </div>
                </div>

                <div class="item">
                    <img src="images/carousel3.png" alt="Team GCC 2017">
                    <div class="carousel-caption">
                        <p>Filière RSR 2018 - 2019</p>
                    </div>
                </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>



<h2>Votre objectif</h2>
<p>Vous n'êtes ici que pour un seul but : découvrir le plus grand secret de l'administrateur du forum, caché précieusement sur son ordinateur. Pour cela, vous allez devoir monter en grade sur le site, de manière plus ou moins astucieuse... </p>



<?php include "footer.php" ?>
