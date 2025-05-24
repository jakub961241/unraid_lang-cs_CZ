#!/usr/bin/php
<?php
function languageErrors() {
	$languageErrorsFile = "<!DOCTYPE html><html><head><title>Unraid Missing Translations</title></head><body>";
	
	$countryCode = "cs_CZ";
	if ( ! $countryCode || $countryCode == "en_US" ) 
		return;
	
	$languageFiles = glob("./{,*/}*.txt",GLOB_BRACE);
	foreach ( $languageFiles as $file ) {
        $languageErrorsFile .= "<font size='6' color='green'>" .$file ."</font><br />";
		$translations = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		foreach ($translations as $line ) {
			$line = trim($line);
			if ( strpos($line,";") === 0 ) // ignore comment lines
				continue;
			if ( ! strpos($line,"=") ) // there is no translation for some reason (incomplete line) / or helptext section
				continue;
			$tr = explode("=",$line);
			if ( ! trim($tr[1]) ) {  // Entry is completely blank
				$languageErrorsFile .= "<i>" .$tr[0] ."</i><br />";
			}
		}
	}
	$languageErrorsFile .= "</body></html>";
	return $languageErrorsFile;
}

echo languageErrors();

?>
