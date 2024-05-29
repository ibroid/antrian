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


class R_ApiController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        try {
            $this->handleCors();
            $this->apiKeyCheck();
        } catch (\Throwable $th) {
            if ($th instanceof ApiException) {
                $th->render_json();
            } else {
                set_status_header(400);
                echo json_encode(["message" => $th->getMessage()]);
            }
        }
    }

    private function handleCors()
    {
        $origin = $_SERVER['HTTP_HOST'] ?? '';
        $separetedOriginUrl = explode(".", $_SERVER["HTTP_HOST"]);
        $domainName = count($separetedOriginUrl) == 3 ? $separetedOriginUrl[1] : $separetedOriginUrl[0];
        $domain = count($separetedOriginUrl) == 3 ? $separetedOriginUrl[2] : $separetedOriginUrl[1];

        if (preg_match('/^https?:\/\/([a-z0-9-]+\.)?' . $domainName . '\.' . $domain . '$/', $_ENV["BASE_URL"])) {
            header("Access-Control-Allow-Origin: $origin");
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
            header("Access-Control-Allow-Credentials: true");
        } else {
            throw new ApiException("CORS policy: No 'Access-Control-Allow-Origin' header is present on the requested resource.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header("HTTP/1.1 204 No Content");
            exit();
        }
    }

    private function apiKeyCheck()
    {
        if (!isset($_ENV["API_KEY"])) {
            throw new ApiException("API KEY not provided in environment");
        }

        $apiKey = R_Input::ci()->request_headers()["Authorization"] ?? '';
        if (!$apiKey) {
            throw new ApiException("API KEY not provided in client");
        }

        if ($apiKey !== $_ENV["API_KEY"]) {
            throw new ApiException("API KEY doesnt match");
        }
    }
}

class ApiException extends Exception
{
    public function __construct($msg)
    {
        parent::__construct($msg);
    }

    public function render_json()
    {
        header("HTTP/1.1 403 Forbidden");
        echo json_encode([
            "message" => $this->getMessage(),
            "data" => null
        ]);
    }
}
