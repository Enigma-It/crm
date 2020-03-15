<?php
	function years()
	{
		$years = array();
		for ($i=2010; $i <= (int)date('Y'); $i++) 
		{ 
			array_push($years, $i);
		}
		return $years;
	}

	function months(){
		$months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
		
		return $months;
	}

	function weeks(){
		$weeks = array(1 => 'Saturday', 2 => 'Sunday', 3 => 'Monday', 4 => 'Tuesday', 5 => 'Wednesday', 6 => 'Thursday', 7 => 'Friday');
		
		return $weeks;
	}

	function gender(){
		$gender = array(1=>'Male', 2=>'Female');
		return $gender;
	}

	function maritalStatus(){
		$maritalStatus = array(1=>'Single',2=>'Married',3=>'Widowed',4=>'Separated',5=>'Not Specified');
		return $maritalStatus;
	}

?>