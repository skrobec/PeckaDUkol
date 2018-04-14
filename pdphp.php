<?php
header("Content-Type: text/html; charset=UTF-8");

if (isset($_POST['input'])) {
$input = $_POST['input'];


$concosants2 =  array("B", "C", "D", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "V", "X", "Z", "W", "Y");
$concosants =  array("b", "c", "d", "f", "f", "h", "j", "k", "l", "m", "n", "p", "q", "r", "s", "t", "v", "x", "z", "w", "y");

$len=strlen($input);
$word = false;
$conc_stream = false;
$start = true;
$output = "";
$concluster = "";
$word_remainder = "";
$wsuffix = "";


for ($i=0; $i<$len; $i++)
{

	if(strcmp($input[$i], " ") == 0 || strcmp($input[$i], ",") == 0 || strcmp($input[$i], ".") == 0 || strcmp($input[$i], "!") == 0 || strcmp($input[$i], "?") == 0)
	{
		if($word == true)
		{
			
			$word = false;
			$output = $output . $word_remainder . '-' . $concluster . $wsuffix . "ay" . " ";
			$wsuffix = "";
			$word_remainder = "";
			$concluster = "";
		
			//done
		}
		if($i+1 < $len)
		{
			if(strcmp($input[$i+1], " ") != 0)
				$start = true;
		}
		

		continue;
	}
	else
	{

		$word = true;
		if( in_array($input[$i] ,$concosants ) || in_array($input[$i] ,$concosants2 ) )
		{
			if(strcmp($input[$i], "Y") == 0 || strcmp($input[$i], "y") == 0 ) // y in yellow == concosant X y in thyself == vowel
			{
				if($start != true)
				{
						$conc_stream = false;
						$word_remainder = $word_remainder . $input[$i];
						if( $i == $len-1)
						{
							$output = $output . $word_remainder . '-' . $concluster . $wsuffix . "ay" . " ";
						}
						continue;
				}
				
			}


			if($start == true)
			{   
				if(strcmp($input[$i], "q") == 0 || strcmp($input[$i], "Q") == 0) // special case according to some Pig Latin site 
				{
					if(strcmp($input[$i+1], "u") == 0 || strcmp($input[$i+1], "U") == 0)
					{
						$concluster = $concluster . $input[$i] . $input[$i+1];
						$i++;
						$conc_stream = true;
						$start = false;
						continue;
					}
				}
				$conc_stream = true;
				$start = false;
			}

			if($conc_stream == true)
			{
				$concluster = $concluster . $input[$i];
			
			}
			else
			{
				$word_remainder = $word_remainder . $input[$i];
				
			}
		}
		else
		{
			if($start == true)
			{
				$wsuffix = "w";
			}
			$conc_stream = false;
			$word_remainder = $word_remainder . $input[$i];
			$start = false;
		}		
	}
	if( $i == $len-1)
	{
		$output = $output . $word_remainder . '-' . $concluster . $wsuffix . "ay" . " ";
	}

}

echo $output;


}

?>