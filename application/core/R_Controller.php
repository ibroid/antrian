<?php

use Pusher\Pusher;

class R_Controller extends CI_Controller
{
    public $user = [];

    public Eloquent $ed;

    public Addons $addons;

    public Pusher $pusher;

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

        $this->pusher = new \Pusher\Pusher(
            'a360f9f6cfefca4c383b',
            'f6262d370d723734da60',
            '1758369',
            [
                'cluster' => 'ap1',
                'useTLS' => true
            ]
        );
    }
}
