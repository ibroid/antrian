<?php

class Loket extends R_Controller
{
  /**
   * Constructor for the Loket class.
   */
  public function __construct()
  {
    parent::__construct();
    $this->addons->init([
      'js' => [
        '<script src="https://unpkg.com/sortablejs@latest/Sortable.min.js"></script>',
        "<script type=\"text/javascript\" src=\"https://unpkg.com/toastify-js\"></script>\n",
        "<script src=\"https://js.pusher.com/8.2.0/pusher.min.js\"></script>"
      ],
      'css' => [
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/toastify-js/src/toastify.min.css\" />\n"
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
   * Fetches the table of loket pelayanan and echoes the component for the table.
   *
   * @throws \Throwable If there is an error fetching the data or rendering the component.
   * @return void
   */
  public function fetch_table_loket_pelayanan()
  {
    R_Input::mustPost();
    try {
      $data = LoketPelayanan::where('status', '!=', 2)->orderBy('urutan')->get();
      echo $this->load->component("table/loket_layar_pelayanan", ["data" => $data]);
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
      'petugas' => Petugas::all()
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

      LoketPelayanan::where('id', Cypher::urlsafe_decrypt(R_Input::pos('id')))->update(R_Input::pos()->except('id')->toArray());

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
}
