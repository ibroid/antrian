<?php


use Phinx\Seed\AbstractSeed;

class JenisPetugasSeeder extends AbstractSeed
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
        $table = $this->table("jenis_petugas");
        $table->insert([
            [
                "nama_jenis" => "Petugas PTSP"
            ],
            [
                "nama_jenis" => "Petugas Sidang"
            ],
            [
                "nama_jenis" => "Petugas Produk"
            ],
            [
                "nama_jenis" => "Kasir"
            ],
            [
                "nama_jenis" => "Petugas Antrian"
            ],
            [
                "nama_jenis" => "Petugas Akta"
            ],
            [
                "nama_jenis" => "Petugas Posbakum"
            ]
        ])->save();
    }
}
