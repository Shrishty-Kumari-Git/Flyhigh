<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {
	public function index()
	{
		redirect(base_url().'flight');
	}

	public function contactus(){
		$this->template->load_view('general/contactus');
	}
	public function aboutus(){
		$this->template->load_view('general/aboutus');
	}
}
