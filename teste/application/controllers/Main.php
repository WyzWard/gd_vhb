<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in')){
			$this->load->model('RestaurantesModel');

			$data = array(
				'restaurantes'	=> $this->RestaurantesModel->restaurantes(),
			);
			$header = array(
				'title' 		=> 'Lista de Retaurantes'
			);
			$this->load->view('resources/header', $header);
			$this->load->view('inicio', $data);
			$this->load->view('resources/footer');
		}else{
			redirect(base_url(''), 'refresh');
		}
	}

	public function restaurante()
	{
		if($this->session->userdata('logged_in')){
			$id = $this->uri->segment(2);
			$this->load->model('RestaurantesModel');

			$data = $this->RestaurantesModel->pratos($id);

			$header = array(
				'title' => $data['restaurante']['restaurante_nome']
			);
			$this->load->view('resources/header', $header);
			$this->load->view('restaurante', $data);
			$this->load->view('resources/footer');
		}else{
			redirect(base_url(''), 'refresh');
		}
	}
}
