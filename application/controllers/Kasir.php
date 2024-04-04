<?php

class Kasir extends R_Controller
{
  public function index()
  {
    $this->load->page("kasir/putus_hari_ini", [
      "perkara_putus_hari_ini" => PerkaraPutusan::where("tanggal_putusan", date("Y-m-d"))->get()
    ])->layout("dashboard_layout", [
      "nav" => $this->load->component("layout/nav_persidangan"),
      "title" => "Monitor Petugas Sidang",
    ]);
  }

  public function form_skum($perkara_id)
  {
    echo $this->load->component("form/form_skum", [
      "penandatangan" => Perkara::findOrFail($perkara_id)->pihak_satu,
      "perkara_id" => $perkara_id
    ]);
  }

  public function cetak_psp()
  {
    R_Input::mustPost();
    try {
      $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("./templates/doc/template_psp.docx");

      $perkara = Perkara::findOrFail(R_Input::pos("perkara_id"));

      $templateProcessor->setValue("NOMOR_PERKARA", $perkara->nomor_perkara);

      $totalTransaksiMasuk = $perkara->biaya->where("jenis_transaksi", 1)->sum("jumlah");

      $totalTransaksiKeluar = $perkara->biaya->where("jenis_transaksi", -1)->sum("jumlah");

      $templateProcessor->setValue("NOMINAL_SISA_PANJAR", rupiah(floatval($totalTransaksiMasuk - $totalTransaksiKeluar)));
      $templateProcessor->setValue("TERBILANG_SISA_PANJAR", terbilang($totalTransaksiMasuk - $totalTransaksiKeluar));
      $templateProcessor->setValue("TANGGAL_SEKARANG", tanggal_indo(date("Y-m-d")));

      $filename = str_replace("/", "_", $perkara->nomor_perkara) . ".docx";
      $templateProcessor->saveAs("./" . $filename);

      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($filename));
      ob_clean();
      flush();
      readfile($filename);

      unlink($filename);
    } catch (\Throwable $th) {
      Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
    }
  }
}
