<?php

class view {	

	/**
	 * @author [Seb Skuse]
	 * @copyright 2008
	 */	
	
	private $viewSource;
	private $originalView;
	private $identifier;
	private $replacements = array();
	private $triggers = array();
	private $wrapperChars = array("{", "}");
	
	const REPLACE_TPL = 0;
	const REPLACE_REGEX = 1;
	const REPLACE_DIRECT = 2;
	
	
	public function __construct($sourcefile = "", $identifier = ""){
		if($sourcefile == ""){
				$this->viewSource = "";
				$this->originalView = "";		
				$this->identifier = "";
		} else {
			$file = realpath( SYS_ASSETDIR . "views/" . $sourcefile . ".html");
			if(file_exists($file) == true){
				$this->viewSource = file_get_contents($file);
				$this->originalView = $this->viewSource;
				$this->identifier = ($identifier == "") ? $sourcefile : "";
			} else {
				throw new Exception("View not found! " . $file);
			}
		}
	}
	
	public function replace($var, $fragment, $method = view::REPLACE_TPL){
	
		array_push($this->replacements, array("from" => $var, "to" => $fragment));
		
		switch($method){

			case view::REPLACE_REGEX:
				$this->viewSource = preg_replace($var, $fragment, $this->viewSource);
			break;

			case view::REPLACE_TPL:	
				$this->internalReplace($var, $fragment);
			break;
			
			case view::REPLACE_DIRECT:
				$this->internalReplace($var, $fragment, view::REPLACE_DIRECT);
			break;
		}
		return $this;
	}

	private function internalReplace($var, $fragment, $method = view::REPLACE_TPL){
		switch($method){
			case view::REPLACE_TPL:
				$format = $this->wrapperChars[0] . strtolower($var) . $this->wrapperChars[1];
			break;

			case view::REPLACE_DIRECT:
				$format = $var;
			break;
		
		}
		
		if(is_object( $fragment ) == true && get_class($fragment) == get_class($this) ){
			$this->viewSource = str_ireplace($format, $fragment->get(), $this->viewSource);
		} else {
			$this->viewSource = str_ireplace($format, $fragment, $this->viewSource);
		}
	}
	
	public function replaceAll(array $data){
		foreach($data as $from => $to){
			$this->replace($from, $to);
		}
		return $this;
	}
	
	// Alias of replaceAll
	public function map(array $data){
		$this->replaceAll($data);
	}
	
	public function replaceWithStatic($var, $template, $path = ""){
		if($template == "") $template = "home";
		$fileStr = SYS_ASSETDIR . "views/" . $path . $template . ".html";
		if(file_exists($fileStr) == true){
			$this->viewSource = str_ireplace($this->wrapperChars[0] . strtolower($var) . $this->wrapperChars[1], file_get_contents($fileStr), $this->viewSource);
		} else {
			throw new Exception("View not found!");
		}
	}
	
	public function reset(){
		$this->viewSource = $this->originalView;
		$this->replacements = array();
	}
	
	public function set($view){
		$this->viewSource = $view;
		$this->originalView = $view;
		
		return $this;
	}
	
	public function append($view){
		$this->viewSource .= $view;
		
		return $this;
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