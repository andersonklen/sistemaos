<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Setup extends CI_Controller{
    public function index(){

    	$this->load->model('setup_model');
    	$this->setup_model->createDatabaseShema();
    }

}

