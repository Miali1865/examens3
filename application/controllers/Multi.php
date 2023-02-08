<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multi extends CI_Controller {
    protected $data = array();

    public function __construct() {
        parent::__construct();
        $this->data['title'] = 'multi Echange - Examen';
        
    }

}

?>
