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

	    public function Password($pw, int $keydate, $return = "md5")
	    {
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
			if($return == "md5")
				return md5($m);
			else
				return crypt(md5($m), '$6$rounds='.$c.'$usesomesillystringforsalt$'); 
	    }

	    public function Filter(array $array, $filter, $mode = "asc")
	    {	
			$t_n = $t_s = $t_num = $t_str = array();
			foreach ($array as $key => $row) {
				if(is_numeric(substr($row[$filter], 0, 1))) {
					$t_n[$key] = $row[$filter];
					$t_num[$key] = $row;
				}
				else {
					$t_s[$key] = $row[$filter];
					$t_str[$key] = $row;
				}
			}
			unset($array);

			$sort = SORT_ASC;
			if($mode == "desc")
				$sort = SORT_DESC;	

			array_multisort($t_n, $sort, SORT_NUMERIC, $t_num);
			array_multisort($t_s, $sort, SORT_STRING, $t_str);
			return array_merge($t_num, $t_str);
	    }

	    public function isMail($val) 
    	{
    		if(filter_var($val, FILTER_VALIDATE_EMAIL))
				return true;
    		else
    			return false;
    	}

	    public function isLink($val) 
    	{
    		if(filter_var($val, FILTER_VALIDATE_URL))
				return true;
    		else
    			return false;
    	}

    	public function isIp($val) 
    	{
    		if(filter_var($val, FILTER_VALIDATE_IP))
				return true;
    		else
    			return false;
    	}

	    public function Protect($v)
	    {
	    	$_a = $_POST;
	    	if($v == "_get")
	    		$_a = $_GET;    		

	    	if($_a) {
		    	foreach($_a as $_k => $_v) {
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