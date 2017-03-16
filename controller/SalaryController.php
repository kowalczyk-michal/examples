<?php
class SalaryController extends Controller {
	private $filename;
	
	public function __construct($args, $outputFile='payment_date') { //standard filename payment_date
		parent::__construct(); 
		
		$this->filename = $outputFile; //filename to generate
	
		//get arguments from cli
		$this->getArguments($args);
	}
	
	/*
	 *	Run application
	 */
	public function run() {
		$this->setCliFilename(); //check filename from cli and set if exist
		
		//Generate salary dates from... today
		$setDate = new DateTime();
		$today = $setDate->format('d/m/Y');
		
		
		//load Salary model
		$salaryModel = $this->loadModel('Salary', $today);

		//Columns for CSV
		$header = array('Month name', 'Base payment', 'Bonus payment');
		
		//Get all Salary and Bonus dates
		$data = $salaryModel->getSalaryDates();
		
		//Generate CSV file
		$this->generateCsv($header, $data);
		
		$this->cliModel->output('Generated!');
	}
	
	/*
	 *	Generate CSV File
	 */
	public function generateCsv($header, $data) {
		//Load Csv Model and create file with content
		$csvModel = $this->loadModel('Csv');
		
		$csvModel->createFile($this->filename, $data, $header);
	}
	
	/*
	 *	Check filename from CLI
	 */
	public function setCliFilename() {
		//validation
		if (empty($this->arguments['filename'])) return false;
		elseif (!$this->cliModel->checkName($this->arguments['filename'])) {
			
			$this->cliModel->output('Filename should contain letters and numbers only! We used default filename.');
			
			return false;
		}
		else $this->filename = $this->arguments['filename'];
	}
}