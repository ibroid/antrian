<?php

class Loket extends R_Controller
{
  /**
   * Constructor for the Loket class.
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->library("addons");
    $this->load->library("form_validation");
    $baseurl = base_url();
    $this->addons->init([
      'js' => [
        "<script src=\"$baseurl/package/htmx/htm.js\"></script>\n",
        '<script src="https://unpkg.com/sortablejs@latest/Sortable.min.js"></script>',
        "<script type=\"text/javascript\" src=\"https://cdn.jsdelivr.net/npm/toastify-js\"></script>\n",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>"
      ],
      'css' => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css\"\" />\n"
      ]
    ]);
  }

  /**
   * Halaman untuk menampilkan daftar loket.
   * Url : /loket. Method : GET.
   *
   * @return page
   */
  public function index()
  {
    $this->load->page("admin/loket/daftar_loket", [
      'lokets' => LoketPelayanan::orderBy('urutan')->get()
    ])->layout("dashboard_layout", [
      'nav' => $this->load->component('layout/nav_admin')
    ]);
  }


  /**
   * Fungsi untuk mengurutkan ulang urutan dari loket.
   * Url : /loket/reorder. Method : POST.
   */
  public function reorder()
  {
    R_Input::mustPost();
    try {
      for ($i = 0; $i < R_Input::pos('panjang'); $i++) {
        $this->eloquent->table('loket_pelayanan')->where('id', R_Input::pos("id")[$i])->update([
          'urutan' => R_Input::pos("urutan")[$i],
          'status' => R_Input::pos("status")
        ]);
      }

      Broadcast::pusher()->trigger('loket-channel', 'reorder-loket', true);

      echo json_encode(["status" => true, "message" => "Berhasil"]);
    } catch (\Throwable $th) {
      set_status_header(400);
      echo json_encode(["status" => false, "message" => $th->getMessage()]);
    }
  }

  /**
   * Edit a specific loket.
   * Url : /loket/edit. Method : GET.
   * @param string $id The ID of the item to edit
   */
  public function edit($id)
  {
    $this->load->page("admin/loket/edit_loket", [
      'loket' => LoketPelayanan::find(Cypher::urlsafe_decrypt($id)),
      'petugas' => Petugas::all(),
    ])->layout("dashboard_layout", [
      'nav' => $this->load->component('layout/nav_admin')
    ]);
  }

  /**
   * Updates a specific loket record in the database.
   * 
   * Url : /loket/update. Method : POST.
   *
   * @throws \Throwable If an error occurs during the update process.
   * @return void
   */
  public function update()
  {
    R_Input::mustPost();
    try {
      $this->form_validation->set_rules('nama_loket', 'Nama Loket', 'required|max_length[64]');
      $this->form_validation->set_rules('warna_loket', 'Warna Loket', 'required|max_length[34]');
      $this->form_validation->set_rules('status', 'Status Loket', 'required|max_length[1]');

      if ($this->form_validation->run() == FALSE) {
        throw new Exception(validation_erros("Kesalahan dalam pengisian form"), 1);
      }

      $dto = [
        "nama_loket" =>  R_Input::pos("nama_loket"),
        "warna_loket" => R_Input::pos("warna_loket"),
        "status" => R_Input::pos("status"),
      ];

      if (isset($_FILES["audio_file"])) {
        $dto["file_audio"] = $this->uploadAudioFile();
        if (!$this->deleteOldAudioFile()) {
          $this->session->set_flashdata("flash_error", $this->load->component("alert/alert_error", ["message" => "Hapus audio lama gagal. Silahkan hubungi admin untuk hapus manual"]));
        }
      }

      LoketPelayanan::where('id', Cypher::urlsafe_decrypt(R_Input::pos('id')))->update($dto);

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(["status" => true, "message" => "Berhasil"]);
        return set_status_header(200);
      }

      return Redirect::wfa([
        "message" => "Berhasil",
        "type" => "success",
        "text" => "Berhasil"
      ])->go("/loket");
    } catch (\Throwable $th) {

      if (R_Input::ci()->request_headers()["Accept"] == "application/json") {
        echo json_encode(["status" => false, "message" => $th->getMessage()]);
        return set_status_header(400);
      }

      return Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
    }
  }

  /**
   * Create new reocord
   * Url : /loket/update
   * Method : POST
   */
  public function create()
  {
    R_Input::mustPost();

    try {
      $this->form_validation->set_rules('nama_loket', 'Nama Loket', 'required|max_length[64]');
      $this->form_validation->set_rules('warna_loket', 'Warna Loket', 'required|max_length[34]');
      $this->form_validation->set_rules('status', 'Status Loket', 'required|max_length[1]');

      if ($this->form_validation->run() == FALSE) {
        throw new Exception(validation_erros("Kesalahan dalam pengisian form"), 1);
      }

      $maxurutan = $this->eloquent->table("loket_pelayanan")->select(
        $this->eloquent::raw('MAX(urutan) as maxnum')
      )->where("status", R_Input::pos('status'))->first();

      $dto = [
        "nama_loket" =>  R_Input::pos("nama_loket"),
        "warna_loket" => R_Input::pos("warna_loket"),
        "status" => R_Input::pos("status"),
        "urutan" => $maxurutan->maxnum + 1
      ];

      $filename = $this->uploadAudioFile();
      $dto["file_audio"] = $filename;

      LoketPelayanan::create($dto);

      Redirect::wfa(["message" => "Loket baru berhasil ditambahkan"])->go("/loket");
    } catch (\Throwable $th) {
      Redirect::wfe($th->getMessage())->go("/loket");
    }
  }

  private function uploadAudioFile()
  {
    $mimes = array('video/mp3', 'application/octet-stream', 'audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3');

    if (!in_array($_FILES['audio_file']['type'], $mimes)) {
      throw new Exception("File harus berupa audio", 1);
    }

    $config['upload_path'] = './audio/loket/';
    $config['allowed_types'] = '*';
    $config['max_size']  = '1024';
    $config['encrypt_name']  = true;

    $this->load->library('upload', $config);

    if (! $this->upload->do_upload("audio_file")) {
      throw new Exception($this->upload->display_errors(), 1);
    }

    $filename = $this->upload->data("file_name");

    return $filename;
  }

  private function deleteOldAudioFile()
  {
    $oldAudioFile = "./audio/nomor_antrian/" . R_Input::pos("old_audio_file");
    if (file_exists($oldAudioFile)) {
      return unlink($oldAudioFile);
    }
    return false;
  }
}
