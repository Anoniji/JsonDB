<?php
/**
 * JsonDB
 *
 * @project: JsonDB Projects
 * @purpose: DB Update for JsonDB
 * @version: 1.0
 *
 * @author: Niji, Ano
 * @created on: 15 Mar, 2018
 *
 * @url: https://anoniji.com
 * @license: Creative Commons
 *
 */

namespace JsonDB
{
	class Update
	{
		public function command_exist($cmd) {
		    $return = shell_exec(sprintf("which %s", escapeshellarg($cmd)));
		    return !empty($return);
		}

		public function Start()
	    {
			if (!$this->command_exist('git')) {
				$this->er = "JsonDB_error_git_not_install";
				return true;
			} else {
			    shell_exec('git clone git://github.com/Anoniji/JsonDB.git '.str_replace("/src/JsonDB", "", __DIR__));
				return true;
			}
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