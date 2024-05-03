<?php


use Phinx\Seed\AbstractSeed;

class LoketPelayananSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $table = $this->table('loket_pelayanan');
        $table->insert([
            [
                "nama_loket" => "Loket Kasir",
                "urutan" => 1,
                "warna_loket" => "success",
                "file_audio" => "ke_loket_kasir.mp3",
                "kode_loket" => "B"
            ],
            [
                "nama_loket" => "Customer Service 1",
                "urutan" => 2,
                "warna_loket" => "secondary",
                "file_audio" => "ke_kastemer_servis_satu.mp3",
                "kode_loket" => "A"
            ],
            [
                "nama_loket" => "Customer Service 2",
                "urutan" => 3,
                "warna_loket" => "secondary",
                "file_audio" => "ke_kastemer_servis_dua.mp3",
                "kode_loket" => "A"
            ],
            [
                "nama_loket" => "Customer Service 3",
                "urutan" => 4,
                "warna_loket" => "secondary",
                "file_audio" => "ke_kastemer_servis_tiga.mp3",
                "kode_loket" => "A"
            ],
            [
                "nama_loket" => "Customer Service 4",
                "urutan" => 5,
                "warna_loket" => "secondary",
                "file_audio" => "ke_kastemer_servis_empat.mp3",
                "kode_loket" => "A"
            ],
            [
                "nama_loket" => "Customer Service 5",
                "urutan" => 6,
                "warna_loket" => "secondary",
                "file_audio" => "ke_kastemer_servis_lima.mp3",
                "kode_loket" => "A",
                "status" => 2
            ],
            [
                "nama_loket" => "Loket Produk",
                "urutan" => 7,
                "warna_loket" => "warning",
                "file_audio" => "ke_loket_produk.mp3",
                "kode_loket" => "D"
            ],
            [
                "nama_loket" => "Loket Posbakum",
                "urutan" => 8,
                "warna_loket" => "primary",
                "file_audio" => "ke_loket_posbakum.mp3",
                "kode_loket" => "C"
            ],
            [
                "nama_loket" => "Loket Pos Indonesia",
                "urutan" => 9,
                "warna_loket" => "warning",
                "file_audio" => "ke_loket_pos_indonesia.mp3",
                "kode_loket" => "F",
                "status" => 2
            ],
            [
                "nama_loket" => "Loket Bank",
                "urutan" => 10,
                "warna_loket" => "info",
                "file_audio" => "ke_loket_bank.mp3",
                "kode_loket" => "G",
                "status" => 2
            ],
        ])
            ->save();
    }
}
