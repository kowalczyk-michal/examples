<?php
class CliModel {
	/*
	 *	Parse arguments - name=>value
	 */
	public function parseArguments($args) {
		$returnArgs = array();
		
		$slicedArgs = array_slice($args, 1); // First argument is a file, we don't want it.
		
		foreach ($slicedArgs as $id => $value) {
			$cutArg = explode('=', $value); // Separate input data, name=value
			
			$returnArgs[$cutArg[0]] = $cutArg[1];
		}
		
		return $returnArgs;
	}
	
	/*
	 *	Filename validation
	 */
	public function checkName($name) {
		//validation - only letters and numbers
		if (ctype_alnum($name)) return true;
		else return false;
	}
	
	/*
	 *	Output text
	 */
	public function output($value) {
		echo $value;
	}
}
?>