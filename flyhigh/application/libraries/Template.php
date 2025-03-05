<?php

class Template {
    var $CI; // Access Codeigniter Object
	public function __construct() {
		$this->CI = &get_instance ();
	}

    public function load_view($view, $page_data=array()){

		$data = [
			'view' => $view,
			'page_data' => $page_data
		];

        $this->CI->load->view('template', $data);
    }

	public function load_isolated_view($view, $page_data=array()){
        $this->CI->load->view( $view, $page_data);
    }
}
