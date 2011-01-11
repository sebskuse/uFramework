<?php

class controller_home extends controller {
	
	private $m_user;
	
	public function renderViewport(){
		// We want access to the user object.
		$this->m_user = $this->objects("user");

		//$videos = '<object width="480" height="385"><param name="movie" value="http://www.youtube.com/p/6931988D67BE162E?hl=en_US&fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/p/6931988D67BE162E?hl=en_US&fs=1" type="application/x-shockwave-flash" width="480" height="385" allowscriptaccess="always" allowfullscreen="true"></embed></object>';

		$latest = new view("frag.latest");

		$this->superview()->replace("sideContent", $latest . util::displayNewInnovators() );
		
		
		
		// Select the tab	
		util::selectTab($this->superview(), "home");

		// Display user box		
		util::userBox($this->m_user, $this->superView());
		
		// Set the default request handler
		$this->bindDefault("homepageHandler");	
	}
	
	
	
	///////////////////////////////////////
	/*									 //
		Content generation functions	 //
	*/									 //
	///////////////////////////////////////
	
	
	protected function homepageHandler(){
		// Set the viewport to the homepage.
		
		// Is the user logged in?
		$name = $this->m_user->getName();
		
		if($name == ""){
			$this->setViewport( new view("homepage") );
		} else {
			$this->setViewport( new view("userHomepage") );
			
			$this->viewport()->replace('name', $this->m_user->getName());
			
			// Get OSSWatch blog articles
			$ossW = new rss('ossw', 'http://osswatch.jiscinvolve.org/wp/feed/');
			$ossW->setLimit(5);
			$ossW->get();
			
			$this->viewport()->replace('ossWRSS', $ossW->getFormatted());
			
			// Get REALISE blog articles
			$reaRSS = new rss('reaRSS', "http://access.ecs.soton.ac.uk/blog/realise/feed/");
			$reaRSS->setLimit(5);
			$reaRSS->get();
			
			$this->viewport()->replace('aecsRSS', $reaRSS->getFormatted());
		}
	
		
	}
	

}

?>