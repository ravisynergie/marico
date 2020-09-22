<?php
/**
 * /application/core/MY_Loader.php
 *
 */

class MY_Loader extends CI_Loader {
	
	public function __construct() 
	{
		parent::__construct();
		require_once BASEPATH.'database/DB.php';
    	$this->db = DB('default', true);		
	}
	
    public function loginTemplate($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
			$content  = $this->view('templates/login/header', $vars, $return);
			$content .= $this->view($template_name, $vars, $return);
			$content .= $this->view('templates/login/footer', $vars, $return);
	
			return $content;
		else:
			$this->view('templates/login/header', $vars);
			$this->view($template_name, $vars);
			$this->view('templates/login/footer', $vars);
		endif;
    }
    
    
    public function innerTemplate($template_name, $vars = array(), $return = FALSE)
    {
        $ci =& get_instance();
		
		$MethodName=$ci->router->fetch_method();
		
		if($return):
			$content  = $this->view('templates/inner/header', $vars, $return);
			$content .= $this->view($template_name, $vars, $return);
			$content .= $this->view('templates/inner/footer', $vars, $return);
			return $content;
    	else:
			$this->view('templates/inner/header', $vars);
			$this->view($template_name, $vars);
			$this->view('templates/inner/footer', $vars);
    	endif;
    }
	

	
}
?>