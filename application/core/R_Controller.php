<?php

class R_Controller extends CI_Controller
{
    public $user = [];

    public Eloquent $ed;

    public Addons $addons;

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_login'))) {

            $this->session->set_flashdata(
                'flash_error',
                $this->load->component(Constanta::ALERT_ERROR, [
                    'message' => 'Anda perlu login terlebih dahulu. <br> Silahkan masukan kredensi anda. Pastikan Semuanya benar',
                ])
            );

            redirect(base_url('auth'));
        }

        $this->user = $this->session->userdata('user_login');
        $this->load->library("Addons");
    }
}
