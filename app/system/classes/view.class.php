<?php

class view {	

	/**
	 * @author [Seb Skuse]
	 * @copyright 2008
	 */	
	
	private $viewSource;
	private $originalView;
	private $identifier;
	
	public function __construct($sourcefile = "", $identifier = ""){
		if($sourcefile == ""){
				$this->viewSource = "";
				$this->source = "";		
				$this->identifier = "";
		} else {
			$file = realpath(SYS_ASSETDIR . "views/" . $sourcefile . ".html");
			if(file_exists($file) == true){
				$this->viewSource = file_get_contents($file);
				$this->source = $this->viewSource;
				$this->identifier = ($identifier == "") ? $sourcefile : "";
			} else {
				throw new Exception("View not found! " . $file);
			}
		}
	}
	
	public function replace($var, $fragment){
		if(is_object( $fragment ) == true && get_class($fragment) == get_class($this) ){
			$this->viewSource = str_ireplace("{" . strtolower($var) . "}", $fragment->get(), $this->viewSource);
		} else {
			$this->viewSource = str_ireplace("{" . strtolower($var) . "}", $fragment, $this->viewSource);
		}
		return $this;
	}
	
	public function replaceAll(array $data){
		foreach($data as $from => $to){
			$this->replace($from, $to);
		}
		return $this;
	}
	
	public function replaceWithStatic($var, $template, $path = ""){
		if($template == "") $template = "home";
		$fileStr = SYS_ASSETDIR . "views/" . $path . $template . ".html";
		if(file_exists($fileStr) == true){
			$this->viewSource = str_ireplace("{" . strtolower($var) . "}", file_get_contents($fileStr), $this->viewSource);
		} else {
			throw new Exception("View not found!");
		}
	}
	
	public function reset(){
		$this->viewSource = $this->source;
	}
	
	public function set($view){
		$this->viewSource = $view;
		$this->originalView = $view;
	}
	
	public function append($view){
		$this->viewSource .= $view;
	}
	
	public function setIdentifier($ident){
		$this->identifier = $ident;
	}
	
	public function get(){
		return $this->viewSource;
	}
	
	public function identify(){
		return $this->identifier;
	}
	
	public function __toString(){
		return $this->viewSource;
	}

}

?>