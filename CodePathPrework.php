<?php

echo '<form action="'.$_SERVER["PHP_SELF"].'" method="post">';

echo '<body bgcolor="#ffdd99">';

echo '<div id="myDiv" name="myDiv" title="CalculatorDiv" style="text-align:center; color: #0900C4; font-family: verdana;border: 1px solid black; width: 40%; border:10px solid green">';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$bill_entry = $_POST["bill_entry"];

	$tip_percentage = $_POST["tip_percentage"];

	echo '<h1> My Tip Calculator </h1>';

	echo '<h1> Please enter the bill: </h1>';

	echo '<h3 style="display:inline-block;">$</h3><input type="text" style="padding:12px 20px;margin:8px 0" value="'.$bill_entry.'" name="bill_entry" id="bill_entry">';

	echo '<h1> Tip percentage: </h1>';

	for ($i = 0; $i < 3; $i++)
	{
		if($tip_percentage == (10 + $i * 5))
		{
			echo '<input type="radio" name="tip_percentage" value="'.(10 + $i * 5).'" checked>'.(10 + $i * 5).'%';
		}
		else
		{
			echo '<input type="radio" name="tip_percentage" value="'.(10 + $i * 5).'">'.(10 + $i * 5).'%';	
		}
	}

	echo '<br> <br>';
	$valuesAreReasonable = false;

	if(is_numeric($bill_entry) && $bill_entry > 0 && $tip_percentage != "")
	{
		$valuesAreReasonable = true;
	}

	if($valuesAreReasonable)
	{
		echo '<div id="mini_Div" name="mini_Div" title="Result Div" style="color: #0900C4; font-family: verdana;border: 1px solid black; width: 50%; border: 5px solid green; margin: 0 auto; text-align:center">';

		echo '<h1> Tip: </h1>';

		$tip = ($tip_percentage / 100) * $bill_entry; 

		echo  '$'.$tip;

		echo '<h1> Total: </h1>';

		echo  '$'.($tip + $bill_entry);

		echo '</div>';
	}

}

else
{
	echo '<h1> My Tip Calculator </h1>';

	echo '<h1> Please enter the bill: </h1>';

	echo '<h3 style="display:inline-block;">$</h3><input type="text" style="padding:12px 20px;margin:8px 0" value="'.$bill_entry.'" name="bill_entry" id="bill_entry">';

	echo '<h1> Tip percentage: </h1>';

	for ($i = 0; $i < 3; $i++)
	{
		echo '<input type="radio" name="tip_percentage" value="'.(10 + $i * 5).'">'.(10 + $i * 5).'%';
	}
	echo '<br> <br>';
}
echo '<input type="submit" value="submit" style="padding:16px 32px; margin:4px 2px; background-color: #008CBA; font-size:16px">';

echo '</div>';

echo '</body>';

echo '</form>';
?>