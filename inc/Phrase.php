<?php
class Phrase
{
	public $currentPhrase;
	public $selected = array();
 	public $phrases   = ['Boldness be my friend', 
 				        'Leave no stone unturned', 
 				  	    'Broken crayons still color', 
 				   	    'The adventure begins', 
 				   		'Dream without fear', 
 				   		'Love without limit'
 				   	   ];
	
	public function __construct($currentPhrase = null, $selected = null)
	{

		if (!empty($selected)) 
		{
			$this->selected = $selected;
		}
		if (!empty($currentPhrase))
		{
			$this->currentPhrase = $currentPhrase;
		}else
		{
			$rand_num = array_rand($this->phrases);
			$this->currentPhrase = $this->phrases[$rand_num];
		}		

	}

	public function addPhraseToDisplay()
	{
		$letterList = str_split(strtolower($this->currentPhrase));
		
		echo '<div id="phrase" class="section">';
		echo "<ul>";
		for ($i=0; $i < count($letterList); $i++) 
		{ 
			if ($letterList[$i] == " ") 
			{
				echo '<li class="space">'.$letterList[$i].'</li>';

			}elseif (in_array($letterList[$i], $this->selected)) 
			{
				echo '<li class="show">'.$letterList[$i].'</li>';
			}else
			{
			    echo '<li class="hide letter">'.$letterList[$i].'</li>';
			}
			// echo "<li class='";
			// echo ($letterList[$i] == " ") ? 'space' : 'hide letter';
			// echo "'>".$letterList[$i]."</li>";	
		}
		echo "</ul>";
		echo "</div>";
	}

	public function getLetterArray()
	{
		$unique_letters = array_unique(str_split(str_replace(' ', '', strtolower($this->currentPhrase))));
		//var_dump($unique_letters);
		return $unique_letters;
	}	

	public function checkLetter($selected_letter)
	{
		return in_array($selected_letter, $this->getLetterArray());
	}
	
	public function numberLost()
	{
		$total_incorrect = array_diff($this->selected, $this->getLetterArray());
		//var_dump($total_incorrect);
		$total_count = count($total_incorrect);
		//var_dump($total_count);
		return $total_count;
	}
}