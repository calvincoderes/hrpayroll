<?php
/**
 * List of methods for formatting strings and other data types.
 * @author AngelaMisa 03/03/2015
 */
class Formatter {
	
	/**
	 * Format Datetime string to given format.
	 * @author AngelaMisa 03/03/2015 7:29pm
	 * @param  $str_date, $format
	 * @return string
	 */
	public static function toDateFormat( $str_date, $format = 'Y-m-d', $add_days = 0) {	
		$date = new DateTime($str_date);
		
		// Has additional days?
		if ( !empty($add_days) ) 
			$date->modify("+$add_days days");

		return $date->format($format);
	}

	/**
	 * Get Excel Format of Column from number to Letter Column
	 * @author Aimon 04/09/2015 9:56AM
	 * @param  $num, $format
	 * @return string
	 */
	public static function toExcelColumnName( $num ) {
	    $numeric = $num % 26;
	    $letter = chr(65 + $numeric);
	    $num2 = intval($num / 26);
	    if ($num2 > 0)
	        return self::toExcelColumnName($num2 - 1) . $letter;

        return $letter;

	}
}