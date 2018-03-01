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

		public function Format()
	    {	
	    	// In development
	    }

	    public function Password($pw, $key)
	    {	
	    	// In development
	    }

	    public function Filter(array $array, $filter, $mode = "asc")
	    {	
	    	// In development
	    }

	    public function Date()
	    {	
	    	// In development
	    }

	    public function Mail()
	    {
	    	// In development
	    }	   

	    public function Number()
	    {
	    	// In development
	    }

	    public function Check()
	    {
	    	// In development
	    }

	    public function Protect()
	    {
	    	// In development
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