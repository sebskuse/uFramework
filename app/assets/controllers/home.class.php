<?php

class controller_home extends controller {
		
	public function run(){
		// Set the default request handler
		$this->bindDefault("homepageHandler");	
	}
	
	
	
	///////////////////////////////////////
	/*									 //
		Content generation functions	 //
	*/									 //
	///////////////////////////////////////
	
	
	protected function homepageHandler(){
		$this->setViewport(new view("home"));
		
		$this->viewport()->replace("controller", __CLASS__);
		$this->viewport()->replace("route", implode($this->context(), "->"));
	}
	

}

?>