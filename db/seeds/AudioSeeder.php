<?php


use Phinx\Seed\AbstractSeed;

class AudioSeeder extends AbstractSeed
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
        $table = $this->table("audio");
        $table->insert([
            [
                "filename" => "anti_gratifikasi.mp3",
                "title" => "Audio Anti Gratifikasi",
                "is_playing" => "no",
                "nama_ketua_penutup" => "yes",
            ],
            [
                "filename" => "tata_tertib.mp3",
                "title" => "Audio Tata Tertib Persidangan",
                "nama_ketua_penutup" => "yes",
                "is_playing" => "no"
            ],
            [
                "filename" => "baca_doa.mp3",
                "title" => "Doa Memulai Aktivitas Kantor",
                "nama_ketua_penutup" => "no",
                "is_playing" => "no"
            ],
            [
                "filename" => "informasi_kalung.mp3",
                "title" => "Informasi Pembagian Identitas Pihak",
                "nama_ketua_penutup" => "no",
                "is_playing" => "no"
            ],
            [
                "filename" => "informasi_dan_pencegahan_percaloan.mp3",
                "title" => "Informasi Pencegahan Percaloan",
                "nama_ketua_penutup" => "no",
                "is_playing" => "no"
            ],
        ])->save();
    }
}
