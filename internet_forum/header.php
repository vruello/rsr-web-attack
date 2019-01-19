<?php 

setlocale(LC_ALL, 'fr_FR.UTF8'); 
include "controller/connexion_base.php";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title><?php
  switch ($pagetitle) {
    case 'index':
      echo "Accueil";
      break;
    case 'forum':
      echo "Forum";
      break;
    case 'documents':
      echo "Documents";
      break;
    case 'profil':
      echo "Profil";
      break;
    case 'inscription':
      echo "Inscription";
      break;
    case 'connexion':
      echo "Connexion";
      break;
    default:
      echo "Nope";
      break;
  } ?> - GCC</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.png">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bubbles.css">

  <style type="text/css">
  html {
    position: relative;
    min-height: 100%;
  }
  footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: auto;
    padding: 10px;
    background-color: #f5f5f5;
  }
  .media{
    width: 100%;
    display: inline-block; 
    position: relative; 
    height: auto; 
    word-wrap: break-word;
    background-color: #F5F5F5; 
    border: 1px solid #DDDDDD; 
    padding: 10px 10px 10px 10px;
  }

  .error{
    color : red;
  }
  </style>

</head>
<body>

<div class="container-fluid" style="padding: 0px;">
  <img src="images/banner.png" class="img-responsive" width="1920px" alt="">
</div>

<nav class="navbar navbar-default">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php" style="padding: 0px;"><img src="images/favicon.png" height="50" width="50" alt=""></a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li <?php if ($pagetitle == "index") {
          ?>
            class="active"
          <?php
        } ?>>
          <a href="index.php">Accueil</a>
        </li>
        <li <?php if ($pagetitle == "forum") {
          ?>
            class="active"
          <?php
        } ?>>
          <a href="forum.php">Forum</a>
        </li>
        <li <?php if ($pagetitle == "documents") {
          ?>
            class="active"
          <?php
        } ?>>
          <a href="documents.php">Documents</a>
        </li>
        <li <?php if ($pagetitle == "profil") {
          ?>
            class="active"
          <?php
        } ?>>
          <a href="profil.php">Profil</a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">

        <?php
          if ($id == 0) {
            echo "<li";
            if ($pagetitle == "inscription") {
              echo " class='active'";
            }
            echo "><a href='inscription.php'>Inscription</a></li>";
          }
        ?>

        <?php
          if ($id == 0) {
            echo "<li";
            if ($pagetitle == "connexion") {
              echo " class='active'";
            }
            echo "><a href='connexion.php'>Connexion</a></li>";
          }
        ?>

        <ul class="nav navbar-nav navbar-right">
            <?php
              if ($id != 0) {?>
                <form class="navbar-form navbar-right">
                  <a href="deconnexion.php">
                    <button type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </button>
                  </a>
                </form>
            <?php
              } 
            ?>
        </ul>
      </ul>
    </div>
  </div>
</nav>

<div class="container" id="page">
