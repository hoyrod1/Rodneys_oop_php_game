<?php
class Game
{
	private $phrase;
	private $lives = 5;

	public function __construct($phrase)
	{
		$this->phrase = $phrase;
	}

	public function displayKeyBoard()
	{
		$keyboard = '';
		$keyboard =  '<form action="play.php" method="post">';
		$keyboard .= '<div id="qwerty" class="section">';
		$keyboard .= '<div class="keyrow">';
		$keyboard .= $this->letterKey('q');
        $keyboard .= $this->letterKey('w');
        $keyboard .= $this->letterKey('e');
        $keyboard .= $this->letterKey('r');
        $keyboard .= $this->letterKey('t');
        $keyboard .= $this->letterKey('y');
        $keyboard .= $this->letterKey('u');
        $keyboard .= $this->letterKey('i');
        $keyboard .= $this->letterKey('o');
        $keyboard .= $this->letterKey('p');
        $keyboard .= '</div>';
		$keyboard .= '<div class="keyrow">';
		$keyboard .= $this->letterKey('a');
        $keyboard .= $this->letterKey('s');
        $keyboard .= $this->letterKey('d');
        $keyboard .= $this->letterKey('f');
        $keyboard .= $this->letterKey('g');
        $keyboard .= $this->letterKey('h');
        $keyboard .= $this->letterKey('j');
        $keyboard .= $this->letterKey('k');
        $keyboard .= $this->letterKey('l');
        $keyboard .= '</div>';
        $keyboard .= '<div class="keyrow">';
        $keyboard .= $this->letterKey('z');
        $keyboard .= $this->letterKey('x');
        $keyboard .= $this->letterKey('c');
        $keyboard .= $this->letterKey('v');
        $keyboard .= $this->letterKey('b');
        $keyboard .= $this->letterKey('n');
        $keyboard .= $this->letterKey('m');
        $keyboard .= '</div>';
        $keyboard .= '</div>';
        $keyboard .= '</form>';
		return $keyboard;
	}
	public function letterKey($letter)
	{
		if (!in_array($letter, $this->phrase->selected)) 
		{
			return '<input type="submit" class="key" name="key" value="'.$letter.'">';
		}elseif ($this->phrase->checkLetter($letter)) 
		{
			return '<input type="submit" class="correct" name="key" value="'.$letter.'" style="background-color: gold" disabled>';
		}else
		{
		    return '<input type="submit" class="incorrect" name="key" value="'.$letter.'" style="background-color: red" disabled>';
		}
	}
	public function displayScore()
	{
		$count = $this->phrase->numberLost();
		$c = 0;
		echo '<div id="scoreboard" class="section">';
		echo "<ol>";
		for ($i=0; $i < $this->lives - $count; $i++) 
		{ 
			echo '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
		}
		for ($i=0; $i < $count; $i++) 
		{ 
			echo '<li class="tries"><img src="images/lostHeart.png" height="35px" widght="30px"></li>';
		}
		echo "</ol>";
		echo "</div>";
	}
	public function checkForWin()
	{
		$letters_selected = $this->phrase->selected;
		$current_phrase   = $this->phrase->getLetterArray();
		$selected_count   = array_intersect($current_phrase, $letters_selected); 
		if (count($selected_count) == count($this->phrase->getLetterArray())) 
		{
			return true;
		}else
		{
			return false;
		}

	}
	public function checkForLose()
	{
		$count = $this->phrase->numberLost();
		$lives = $this->lives;
		if ($count == $lives) 
		{
		  return true;
		}else
		{
		  return false;	
		}
	}
	public function gameOver()
	{
		if ($this->checkForLose()) 
		{
			return '<h1 id="game-over-message">The phrase was: <strong>"'. $this->phrase->currentPhrase .'"</strong>. Better luck next time!</h1><br><form action="play.php" method="post">
                <input id="btn__reset" type="submit" name="start" value="Play Again" />
            </form>';
		}elseif ($this->checkForWin()) 
		{
			return '<h1 id="game-over-message">Congratulations on guessing: "'. $this->phrase->currentPhrase .'"</strong></h1><br><form action="play.php" method="post">
                <input id="btn__reset" type="submit" name="start" value="Play Again" />
            </form>';
		}else
		{
			return false;
		}
	}
}