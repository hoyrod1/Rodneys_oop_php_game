<?php 
session_start();

if (isset($_POST['start'])) 
{
  unset($_SESSION['selected']);
  unset($_SESSION['phrase']);
}

if (isset($_POST['key']) && isset($_SESSION['selected'])) 
{
    $_SESSION['selected'][] = $_POST['key'];
}else
{
    $_SESSION['selected']= [];
}

include 'inc/Phrase.php';
include 'inc/Game.php';

if (isset($_SESSION['phrase'])) 
{
    $phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);    
}else
{
    $phrase = new Phrase();
    $_SESSION['phrase'] = $phrase->currentPhrase;
}

$game = new Game($phrase);
//var_dump($game->checkForLose());

//var_dump($game);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Phrase Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
<div class="main-container">
        <h2 class="header">Phrase Hunter</h2>
            <?php
            echo $game->gameOver();
            echo $phrase->addPhraseToDisplay(); 
            echo $game->displayKeyBoard(); 
            echo $game->displayScore(); 
            //var_dump($_POST);
            ?>  
        
</div>

</body>
</html>
