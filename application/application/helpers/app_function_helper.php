<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function isValidSession()
{    
   redirect(base_url(), 'refresh');  
}

?>