<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Bonjour extends CI_Controller {

        public function categorie($id = 1) {
            $data = array();
            $data['icon'] = 'hey';
            $data['nom'] = 'Kiraro';
            $this->load->view('Result',$data);
        } 
    }
?>