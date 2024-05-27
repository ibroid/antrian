<?php

use Pusher\Pusher;

class R_Controller extends CI_Controller
{
    /**
     * Mendefinisikan variabel user yang berisi array kosong yang akan diisi oleh record user yang telah login.
     * @var array
     */
    public array $user = [];

    /**
     * Mendefinisikan variable id_admin yang akan di set ulang apabila user yang login adalah admin.
     * @var bool
     */
    public bool $is_admin = FALSE;

    /**
     * Inisialisasi library eloquent
     * @var Eloquent
     */
    public Eloquent $eloquent;

    /**
     * Inisialisasi library addons
     * @var Addons
     */
    public Addons $addons;

    /**
     * Inisialisasi fungsi construct. 
     * Mengecek apakah user sudah login atau belum.
     * Mengisikan variabel user dengan record user yang login.
     * Inisialisasi Pusher.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->eloquent->table('user_session')->where('expiration_time', '<', date('Y-m-d H:i:s'))->delete();

        if (empty($this->session->userdata('user_login'))) {

            $this->session->set_flashdata(
                'flash_error',
                $this->load->component(Constanta::ALERT_ERROR, [
                    'message' => 'Anda perlu login terlebih dahulu. <br> Silahkan masukan kredensi anda. Pastikan Semuanya benar',
                ])
            );

            $this->session->set_userdata("redirect_dest", $_SERVER["REQUEST_URI"]);

            redirect(base_url('auth'));
        }

        $this->user = $this->session->userdata('user_login');

        if ($this->user["role_id"] == 1) {
            $this->is_admin = TRUE;
        }

        $this->load->library("Addons");
    }
}
