<?php
/**
 * JsonDB
 *
 * @project: JsonDB Projects
 * @purpose: DB functions for JsonDB
 * @version: 1.0
 *
 * @author: Niji, Ano
 * @created on: 01 Mar, 2018
 *
 * @url: https://anoniji.com
 * @license: Creative Commons
 *
 */

namespace JsonDB
{
	class Functions
	{
		protected $er;
		protected $ky;

		public function __construct($db = 'default')
	    {
	    	$JsonDB = __DIR__ . '/key.JsonDB';
			if(!file_exists($JsonDB))
	    		$this->er = "JsonDB_error_init";
	    	else
	        	$this->ky = date("dmYHis", filemtime($JsonDB));
	    }

	    public function Password($pw, int $keydate)
	    {
	    	// In development
			$c = "0";
			for ($i = 0, $j = strlen($pw); $i < $j; $i++) { 
				$_a[] = ord($pw{$i});
			} 
			foreach($_a as $_a) { 
				$so = $_a + $key + $c;
				$m_i = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
				$m_o = array("*", "8", "5", "3", "2", "1", "9", "6", "4", "7");
				$m = str_replace($m_i, $m_o,  $so);
				$m .= $m;
				$c = $c + $this->ky;
			} 
			return md5($m);
	    }

	    public function Filter(array $array, $filter, $mode = "asc")
	    {	
			$tn = $ts = $temp_num = $temp_str = array();
			foreach ($array as $key => $row) {
				if(is_numeric(substr($row[$filter], 0, 1))) {
					$tn[$key] = $row[$filter];
					$temp_num[$key] = $row;
				}
				else {
					$ts[$key] = $row[$filter];
					$temp_str[$key] = $row;
				}
			}
			unset($array);
			if($mode == "desc")
				$sort = SORT_DESC;
			else
				$sort = SORT_ASC;

			array_multisort($tn, $sort, SORT_NUMERIC, $temp_num);
			array_multisort($ts, $sort, SORT_STRING, $temp_str);
			return array_merge($temp_num, $temp_str);
	    }

	    public function Check($type, $value, array $options)
	    {
	    	// In development
	    	if($type == "datetime") {
	    		if(!$option[1])
	    			$option[1] = "UTC";
	    		date_default_timezone_set($option[1]);
	    		return date($value, $option[0]);
	    	}
	    }

	    public function Protect($v)
	    {
	    	// In development
	    	if($v == "_get") {
		    	foreach($_GET as $_k => $_v) {
					$ex1 = explode("<", $_v);
					$ex2 = explode(">", $_v);
					$ex3 = explode("%", $_v);
					$ex4 = explode("?", $_v);
					$ex5 = explode("&", $_v);

					if($ex1[1] == true || $ex2[1] == true || $ex3[1] == true || $ex4[1] == true || $ex5[1] == true)
						die();
				}
	    	} else if($v == "_post") {
		    	foreach($_POST as $_k => $_v) {
					$ex1 = explode("<", $_v);
					$ex2 = explode(">", $_v);
					$ex3 = explode("%", $_v);
					$ex4 = explode("?", $_v);
					$ex5 = explode("&", $_v);

					if($ex1[1] == true || $ex2[1] == true || $ex3[1] == true || $ex4[1] == true || $ex5[1] == true)
						die();
				}
	    	} else
		    	return strip_tags($v);
	    }

	    /**
	     * @return Error
	     */
	   	public function getError()
	    {
	        return $this->er;
	    }
	}
}
?>