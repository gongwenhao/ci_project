<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		echo '<h1>欢迎访问</h1>';
		// $this->load->model('sys_user_model');
		// $data = $this->sys_user_model->return_query_table(array());
		// $this->load->database();
		// $query = $this->db->query('select * from sys_user limit 1');
		// echo $this->db->last_query();
		// echo '<pre>';
		// var_dump($data);
		// $this->load->view('welcome_message');
	}
}
