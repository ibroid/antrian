<?php
class Timeline
{
    public function __construct(
        $judul,
        $tanggal,
        $keterangan,
        $isi,
        $color = "bg-primary"
    ) {
        $this->judul = $judul;
        $this->tanggal = $tanggal;
        $this->keterangan = $keterangan;
        $this->isi = $isi;
        $this->color = $color;
    }
}
