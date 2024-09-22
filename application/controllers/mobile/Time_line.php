<?php

class Time_line extends R_MobileController
{
    public $data;

    public function __construct()
    {
        parent::__construct();
        if (R_Input::isPost()) {
            try {
                $perkara = Perkara::where('nomor_perkara', R_Input::pos('nomor_perkara'))->first();

                if (!$perkara) {
                    echo "Perkara anda tidak ditemukan.";
                    exit;
                }

                $timeline = collect([
                    new Timeline(
                        "Pendaftaran Perkara",
                        tanggal_indo($perkara->tanggal_pendaftaran),
                        "Diinput Oleh Admin",
                        "Perkara berhasil didaftarkan di Pengadilan Agama Jakarta Utara",
                    )
                ]);

                if ($perkara->penetapan) {
                    $timeline->push(
                        new Timeline(
                            "Penetapan Majelis Hakim",
                            tanggal_indo($perkara->penetapan->penetapan_majelis_hakim),
                            "Diinput Oleh Admin",
                            "Ditetapkan Hakim sebagai berikut : " . str_replace("<br/>", ". ", $perkara->penetapan->majelsi_hakim_nama),
                            "bg-warning"
                        ),
                        new Timeline(
                            "Penetapan Panitera Pengganti",
                            tanggal_indo($perkara->penetapan->penetapan_panitera_pengganti),
                            "Diinput Oleh Admin",
                            "Ditetapkan Panitera sebagai berikut : " . str_replace("<br/>", ". ", $perkara->penetapan->panitera_pengganti_text),
                            "bg-warning"
                        ),
                        new Timeline(
                            "Penetapan Jurusita",
                            tanggal_indo($perkara->penetapan->penetapan_jurusita),
                            "Diinput Oleh Admin",
                            "Ditetapkan Jurusita sebagai berikut : " . str_replace("<br/>", ". ", $perkara->penetapan->jurusita_text),
                            "bg-warning"
                        )
                    );
                }

                if ($perkara->jadwal_sidang) {
                    foreach ($perkara->jadwal_sidang as $n => $pjs) {
                        $timeline->push(
                            new Timeline(
                                "Persidangan",
                                tanggal_indo($pjs->tanggal_sidang),
                                "Sidang ke $pjs->urutan",
                                "Agenda Sidang : $pjs->agenda",
                                "bg-success"
                            )
                        );
                    }
                }

                if ($perkara->putusan) {
                    $timeline->push(
                        new Timeline(
                            "Putusan Perkara",
                            tanggal_indo($perkara->putusan->tanggal_putusan),
                            "Diputus secara " . (function ($verstek) {
                                if ($verstek == "Y") {
                                    return "Verstek";
                                }
                                return "Bersama";
                            })($perkara->putusan->putusan_verstek),
                            "Perkara sudah diputus dan menunggu proses BHT",
                            "bg-info"
                        )
                    );
                }

                if (isset($perkara->putusan->tanggal_bht)) {
                    $timeline->push(
                        new Timeline(
                            "Penguatan Hukum Tetap pada Putusan Perkara",
                            tanggal_indo($perkara->putusan->tanggal_putusan),
                            "Diinput oleh admin ",
                            "Putusan sudah Berkekuatan Hukum Tetap",
                            "bg-info"
                        )
                    );
                }

                if ($perkara->akta_cerai) {
                    $timeline->push(
                        new Timeline(
                            "Penerbitan Akta Cerai",
                            tanggal_indo($perkara->akta_cerai->tgl_akta_cerai),
                            "Nomor Akta : " . $perkara->akta_cerai->nomor_akta_cerai,
                            "Akta Cerai sudah terbit dan bisa di ambil satu(1) hari setelah penerbiatan.",
                            "bg-danger"
                        )
                    );
                }

                if (isset($perkara->akta_cerai->tgl_penyerahan_akta_cerai)) {
                    $timeline->push(
                        new Timeline(
                            "Pengambilan Akta Cerai",
                            tanggal_indo($perkara->akta_cerai->tgl_penyerahan_akta_cerai),
                            "Diambil oleh pihak Penggugat/Pemohon",
                            "Akta Cerai sudah diambil oleh Penggugat/Pemohon.",
                            "bg-danger"
                        )
                    );
                }

                if (isset($perkara->akta_cerai->tgl_penyerahan_akta_cerai2)) {
                    $timeline->push(
                        new Timeline(
                            "Pengambilan Akta Cerai",
                            tanggal_indo($perkara->akta_cerai->tgl_penyerahan_akta_cerai2),
                            "Diambil oleh pihak Tergugat/Termohon",
                            "Akta Cerai sudah diambil oleh Tergugat/Termohon.",
                            "bg-danger"
                        )
                    );
                }

                $data = [
                    "perkara_id" => Cypher::urlsafe_encrypt($perkara->perkara_id),
                    "nomor_perkara" => $perkara->nomor_perkara,
                    "data" => $timeline
                ];

                $this->data = $data;
            } catch (\Throwable $th) {
                echo "Terjadi kesalahan: " . $th->getMessage();
            }
        }
    }

    public function index()
    {
        return $this->fullRender("timeline_search_page");
    }

    public function page()
    {
        return $this->pageRender("timeline_search_page");
    }

    public function search()
    {
        if (R_Input::ci()->method() == "post") {
            return $this->pageRender("timeline_found_page", [
                "timeline" => $this->data
            ]);
        }
        return show_404();
    }
}
