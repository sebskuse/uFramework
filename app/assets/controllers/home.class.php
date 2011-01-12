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
		$this->setViewport(new view());
			
	}
	

}

?>