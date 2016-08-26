<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriasController extends CI_Controller {
	
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function all()
	{
		$this->load->model('CategoriaModel');
		$categoria = $this->CategoriaModel->getAll();
		echo json_encode($categoria);
	}
}
