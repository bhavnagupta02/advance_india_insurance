<?php
	$this->load->view('admin/layouts/header', $title);
	$this->load->view('admin/layouts/sidebar');
	$this->load->view($content);
	$this->load->view('admin/layouts/footer');
?>