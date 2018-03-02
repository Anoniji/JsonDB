<?php
/**
 * JsonDB
 *
 * @project: JsonDB Projects
 * @purpose: DB connect for JsonDB
 * @version: 1.0
 *
 * @author: Niji, Ano
 * @created on: 28 Feb, 2018
 *
 * @url: https://anoniji.com
 * @license: Creative Commons
 *
 */

namespace JsonDB
{
	class Connect
	{
		protected $db;
		protected $tb;
		protected $ky;
		protected $er;
		protected $dir_db;
		protected $dir_tb;
		protected $_tb;
		protected $_key;
		protected $_str;

		public function __construct($db = 'default')
	    {
	    	$JsonDB = __DIR__ . '/key.JsonDB';
			if(!file_exists($JsonDB))
	    		if(!file_put_contents($JsonDB, "", LOCK_EX))
	    			$this->er = "JsonDB_error_init";

	        $this->ky = date("dmYHis", filemtime($JsonDB));
			$this->dir_db = __DIR__ . '/' . md5($this->ky.$this->db);

	        if(!is_dir($this->dir_db))
				if(!mkdir($this->dir_db, 0700))
					$this->er = "db_error_create";
				else
					file_put_contents($this->dir_db.'/index.html', "", LOCK_EX);
	    }

	    public function Jtb($tb = 'default', array $s)
	    {
	    	$this->dir_tb = $this->dir_db."/".md5($tb).".".md5($this->ky);
	    	if(!file_exists($this->dir_tb)) {
	    		$_tb = array();
	    		$_tb["_str"] = $s;
	    		if(!file_put_contents($this->dir_tb, json_encode($_tb, JSON_PRETTY_PRINT), LOCK_EX))
	    			$this->er = "tb_error_create";
	    		else
	    			return "JsonDB: Created";
	    	} else
	    		return "JsonDB: TB LOAD";    		
	    }

	    public function Insert(array $s)
	    {
	    	if(file_exists($this->dir_tb)) {
	    		$_tb = json_decode(file_get_contents($this->dir_tb), true);
	    		$c1 = count($_tb["_str"]);
	    		$c2 = count($s);
	    		if($c1 === $c2) {
					$_a = array();
					$i = 0;
		    		foreach ($_tb["_str"] as $k => $v) {
						$_a[$k] = $s[$i];
						$i++;
		    		}
		    		array_push($_tb, $_a);
		    		file_put_contents($this->dir_tb, json_encode($_tb, JSON_PRETTY_PRINT), LOCK_EX);
		    		return "JsonDB: Insert Data"; 	    			
	    		} else
	    			$this->er = "tb_structure_error";
	    	} else
	    		$this->er = "tb_not_create";
	    }	   

	    public function Select($key = false, $o = '=', $value = false, $select = 'one')
	    {
			if(file_exists($this->dir_tb) && $key && $value) {
	    		$_tb = json_decode(file_get_contents($this->dir_tb), true);
	    		$this->_str = $_tb["_str"];
	    		unset($_tb["_str"]);

	    		$_array = array();
	    		foreach ($_tb as $k_v) {
	    			foreach($k_v as $L_k => $L_v) {
	    				if($this->_str[$L_k] == "int")
	    					$k_v[$L_k] = intval($L_v);
	    				else if($this->_str[$L_k] == "double")
	    					$k_v[$L_k] = doubleval($L_v);
	    				else if($this->_str[$L_k] == "float")
	    					$k_v[$L_k] = floatval($L_v);
	    				else if($this->_str[$L_k] == "bool")
	    					$k_v[$L_k] = boolval($L_v);
	    			}
					if($k_v[$key] != $value && $o == "!=")
	    				array_push($_array, $k_v);
	    			else if(intval($k_v[$key]) < intval($value) && $o == "<")
	    				array_push($_array, $k_v);
	    			else if(intval($k_v[$key]) <= intval($value) && $o == "<=")
	    				array_push($_array, $k_v);
	    			else if(intval($k_v[$key]) >= intval($value) && $o == ">=")
	    				array_push($_array, $k_v);
	    			else if(intval($k_v[$key]) > intval($value) && $o == ">")
	    				array_push($_array, $k_v);
	    			else if($k_v[$key] == $value)
	    				array_push($_array, $k_v);
	    		}

				if($select == 'all')
					return $_array;
				else
					return $_array[0];
			} else
	    		$this->er = "tb_not_create";
	    }

	    public function Update($key = false, $value = false, array $s)
	    {
	    	if(file_exists($this->dir_tb) && $key && $value) {
	    		$_tb = json_decode(file_get_contents($this->dir_tb), true);
	    		$_key = array_search($value, array_column($_tb, $key)) - 1;
	    		foreach ($s as $key => $value) {
	    			$_tb[$_key][$key] = $value;
	    		}
	    		if(!file_put_contents($this->dir_tb, json_encode($_tb, JSON_PRETTY_PRINT), LOCK_EX))
	    			$this->er = "tb_error_update";
	    		else
	    			return "JsonDB: Update Data [".$_key."]"; 
	    	} else
	    		$this->er = "tb_not_create";
	    }

	   	public function Delete($key = false, $value = false)
	    {
	    	if(file_exists($this->dir_tb) && $key && $value) {
	    		$_tb = json_decode(file_get_contents($this->dir_tb), true);
	    		foreach ($_tb as $k_v) {
	    			if($k_v[$key] == $value) {
			    		try {
			    			unset($k_v);
			    			file_put_contents($this->dir_tb, json_encode($_tb, JSON_PRETTY_PRINT), LOCK_EX);
			    			return "JsonDB: Delete"; 
			    		}
			    		catch(Exception $e) {
			    			$this->er = "tb_error_delete: " . $e->getMessage();
			    		}
	    			}
	    		}
	    	} else
	    		$this->er = "tb_not_create";
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