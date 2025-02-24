<?php


class Banner extends ControlAdmin
{
  public function __construct()
  {
    parent::__construct();
    $baseUrl = base_url();

    $this->addons->init([
      "js" => [
        "<script type=\"text/javascript\" src=\"https://unpkg.com/toastify-js\"></script>\n",
        "<script src=\"https://unpkg.com/sweetalert2@11\"></script>",
        "<script src='" . base_url() . "assets/js/form-validation-custom.js'></script>",
      ],
      "css" => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/toastify-js@1.12.0/src/toastify.css\">\n",
        "<script type=\"text/javascript\" src=\"$baseUrl/package/htmx/htm.js\"></script>\n"
      ]
    ]);
  }

  public function index()
  {
    $this->page();
  }

  private function page()
  {
    $this->load->page("admin/banner/daftar_banner", [
      "banners" => Eloquent::table("banner_pengumuman")->get()
    ])->layout("dashboard_layout", [
      "title" => "Antrian Pelayanan",
      "nav" => $this->load->component("layout/nav_admin")
    ]);
  }

  public function create()
  {
    R_Input::mustPost();
    try {
      $config['upload_path'] = './uploads/banner/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']  = '2048';
      $config['max_width']  = '1280';
      $config['max_height']  = '850';
      $config['file_name'] = time();

      $this->load->library('upload', $config);

      if (! $this->upload->do_upload('file_banner')) {
        throw new Exception($this->upload->display_errors(), 1);
      }

      Eloquent::connection("default")->beginTransaction();

      Eloquent::table("banner_pengumuman")->insert([
        'filename' => $this->upload->data('file_name'),
        'description' => R_Input::pos("desc")
      ]);

      Eloquent::connection("default")->commit();

      Redirect::wfa(["message" => "Banner berhasil ditambahkan"])->go("/banner");
    } catch (\Throwable $th) {
      Eloquent::connection("default")->rollBack();
      Redirect::wfa($th->getMessage())->go("/banner");
    }
  }

  public function delete($id = null)
  {
    if ($this->input->method() != "delete") {
      echo show_404();
      exit;
    }

    try {
      $banner = Eloquent::table("banner_pengumuman")->where("id", Cypher::urlsafe_decrypt($id))->first();
      if (!$banner) {
        throw new Exception("Banner tidak ditemukan", 1);
      }

      $fullpath = "./uploads/banner/" . $banner->filename;
      if (file_exists($fullpath)) {
        if (!unlink($fullpath)) {
          $this->session->set_flashdata(
            'flash_error',
            $this->load->component("alert/alert_error", ["message" => "File tidak dapat dihapus. Silahkan hapus manual"])
          );
        }
      } else {
        $this->session->set_flashdata(
          'flash_error',
          $this->load->component("alert/alert_error", ["message" => "File tidak ditemukan di " . $fullpath . ". Silahkan hapus manual"])
        );
      }
      Eloquent::table("banner_pengumuman")->where("id", Cypher::urlsafe_decrypt($id))->delete();

      Redirect::wfa(["message" => "Banner telah dihapus"]);
      header("HX-Refresh: true");
    } catch (\Throwable $th) {
      Redirect::wfe($th->getMessage());
      header("HX-Refresh: true");
    }
  }
}
