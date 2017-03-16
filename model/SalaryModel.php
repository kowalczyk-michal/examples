<?php
class SalaryModel {
	private $fromDate;
	
	
	public function __construct($date) {
		//set "from date" format
		$setDate = new DateTime($date);
		$this->fromDate = $setDate->format('d/m/Y');
	}
	
	/*
	 *	Get all salary and bonus dates
	 */
	public function getSalaryDates() {
		$dates=array();
		
		$months = $this->getMonths(); //get next months
		
		//get month name, last working day, bonus date and set into array
		foreach ($months as $id => $month) {
			$dates[] = array($this->getMonthName($month), $this->getLastWorkingDay($month), $this->getBonusDay($month));
		}
		
		return $dates;
	}
	
	/*
	 *	Get next months
	 */
	public function getMonths($amount=12) {
		$months=array();
		
		for ($i=0;$i<=$amount;$i++) {
			$setDate = new DateTime($this->fromDate);
			$months[] = $setDate->modify('+'.$i.' months')->format('d/m/Y');
		}
		
		return $months;
	}
	
	/*
	 *	Name of the month
	 */
	public function getMonthName($date) {
		$setDate = new DateTime();
		
		return $setDate->createFromFormat('d/m/Y', $date)->format('F');
	}
	
	/*
	 *	Get last working day of the month
	 */
	public function getLastWorkingDay($date) {
		//get last day of the month (number)
		$setDate = new DateTime();
		$days = $setDate->createFromFormat('d/m/Y', $date)->format('t');
		
		//get only month and year
		$setDate = new DateTime();
		$newFormat = $setDate->createFromFormat('d/m/Y', $date)->format('m/Y');
		
		//check number of day of the week
		$setDate = new DateTime();
		$day = $setDate->createFromFormat('d/m/Y', $days.'/'.$newFormat)->format('N');
		
		if ($day == 6) $lastWorkingNumberDay = $days-1; // if saturday, 1 day before is a working day
		elseif ($day == 7)  $lastWorkingNumberDay = $days-2;  // if sunday, 2 days before is a working day
		else $lastWorkingNumberDay = $days;
		
		$setDate = new DateTime();
		$lastWorkingDay = $setDate->createFromFormat('d/m/Y', $lastWorkingNumberDay.'/'.$newFormat)->format('d/m/Y'); // last working day, day/month/year
		
		return $lastWorkingDay;
	}
	
	/*
	 *	Get bonus day
	 */
	public function getBonusDay($date) {
		//get only month and year
		$setDate = new DateTime();
		$newFormat = $setDate->createFromFormat('d/m/Y', $date)->format('m/Y');
		
		//get number of day of the week
		$setDate = new DateTime();
		$checkBonusDate = $setDate->createFromFormat('d/m/Y', '12/'.$newFormat)->format('N');
		
		//if weekend, next tuesday
		if ($checkBonusDate == 6 || $checkBonusDate == 7) {
			$setDate = new DateTime();
			$bonusDate = $setDate->createFromFormat('d/m/Y', '12/'.$newFormat)->modify('next tuesday')->format('d/m/Y'); //next tuesday from 12th
		}
		else $bonusDate = '12/'.$newFormat; //if isn't weekend, correct
		
		return $bonusDate;
	}
}