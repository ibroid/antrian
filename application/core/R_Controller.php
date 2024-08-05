<?php

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
        if ($_SERVER['HTTP_HOST'] !== 'antrian.test') {
            if ($_SERVER['HTTP_CF_IPCOUNTRY'] !== 'ID') {
                http_response_code(403);
                die();
            }

            $remoteIp = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'];
            if ($remoteIp !== $_ENV['ALLOWED_REMOTE_IP']) {
                http_response_code(403);
                die();
            }
        }

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

    public Eloquent $eloquent;

    public function __construct()
    {
        parent::__construct();

        if ($_SERVER['HTTP_HOST'] !== 'antrian.test') {
            if ($_SERVER['HTTP_CF_IPCOUNTRY'] !== 'ID') {
                http_response_code(403);
                die();
            }

            $remoteIp = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'];
            if ($remoteIp !== $_ENV['ALLOWED_REMOTE_IP']) {
                http_response_code(403);
                die();
            }
        }

        try {
            $this->handleCors();
            $this->apiKeyCheck();
        } catch (\Throwable $th) {
            if ($th instanceof ApiException) {
                $th->render_json();
                die;
            } else {
                set_status_header(400);
                echo json_encode(["message" => $th->getMessage()]);
                die;
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
            header("Access-Control-Allow-Origin: *");
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
        // prindie(R_Input::ci()->request_headers());
        $apiKey = R_Input::ci()->request_headers()["Authorization"] ?? null;

        if (!$apiKey) {
            throw new ApiException("API KEY not provided in client");
        }

        if (strpos($apiKey, 'Bearer ') === 0) {
            $apiKey = substr($apiKey, 7); // Hapus 'Bearer '
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
        // header("HTTP/1.1 403 Forbidden");
        echo json_encode([
            "message" => $this->getMessage(),
            "data" => null
        ]);
    }
}

trait ApiResponse
{
    private function ok($data, $message = "Berhasil")
    {
        set_status_header(200);
        header('Content-Type: application/json');
        echo json_encode([
            "message" => $message,
            "data" => $data
        ]);
    }

    private function fail($err, $stack = null, $message = "Terjadi kesalahan")
    {
        set_status_header(400);
        header('Content-Type: application/json');
        echo json_encode([
            "message" => $message,
            "error" => $err,
            "stack" => $stack
        ]);
    }
}

class R_MobileController extends CI_Controller
{
    public $headerMenu;

    public $visitor;

    public $settings;

    public function __construct()
    {
        if ($_SERVER['HTTP_HOST'] !== 'antrian.test') {
            if ($_SERVER['HTTP_CF_IPCOUNTRY'] !== 'ID') {
                http_response_code(403);
                die();
            }
        }

        parent::__construct();
        $this->headerMenu = [
            "app_header" => $this->load->view("mobile/components/app_header", null, true),
            "app_bottom_menu" => $this->load->view("mobile/components/app_bottom_menu", null, true),
        ];

        $referer = parse_url(R_Input::ci()->request_headers()["Hx-Current-Url"] ?? null);

        if ($referer['path'] != null) {
            parse_str($referer['query'] ?? "", $par);
        }

        $this->visitor = $this->eloquent->table("visitor")->find(Cypher::urlsafe_decrypt($par['visitor'] ?? null));
    }

    public function fullRender($page, $data = [])
    {
        $this->load->page("mobile/" . $page, $data)->layout("mobile_layout", $this->headerMenu);
    }

    public function pageRender($page, $data = [])
    {
        echo $this->load->view("mobile/" . $page,  $data, true);
    }

    public function componentRender($comp, $data = [])
    {
        echo $this->load->view("mobile/components/" . $comp,  $data, true);
    }

    public function visitor_register()
    {
        try {
            $this->eloquent->connection("default")->beginTransaction();

            $visitor = Visitors::where([
                "id" => Cypher::urlsafe_decrypt(R_Input::pos("visitor")),
            ])->first();

            if (!$visitor) {
                $visitor = Visitors::create([
                    "visit_date" => date("Y-m-d"),
                    "remote_ip" => $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'],
                    "user_agent" => $_SERVER['HTTP_USER_AGENT'],
                    "country_id"  => $_SERVER['HTTP_CF_IPCOUNTRY'] ?? "UKWN",
                    "device" => R_Input::pos("device"),
                    "antrian_ptsp_id" => Cypher::urlsafe_decrypt(R_Input::pos("antrian_ptsp")),
                    "antrian_sidang_id" => Cypher::urlsafe_decrypt(R_Input::pos("antrian_sidang"))
                ]);
            }

            if (!$visitor->antrian_ptsp_id or !$visitor->antrian_sidang_id) {
                $this->eloquent::table("mobile_notification")->updateOrInsert([
                    "visitor_id" => $id ?? $visitor->id,
                ], [
                    "title" => "System Notification",
                    "body" => "Kami tidak bisa mengirim pemberitahuan panggilan antrian kepada anda. Klik untuk mendapatkan pemberitahuan dan layanan yang lebih banyak.",
                    "action" => "call_function",
                    "action_param" => "data-bs-dismiss=\"modal\" onclick=\" notification('no-antrian-notif')\"",
                ]);
            }

            $this->eloquent->connection("default")->commit();

            return Cypher::urlsafe_encrypt($id ?? $visitor->id);
        } catch (\Throwable $th) {
            $this->eloquent->connection("default")->rollback();

            set_status_header(400);
            echo "Terjadi kesalahan. " . $th->getMessage();
        }
    }
}
