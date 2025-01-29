<?php


use Phinx\Seed\AbstractSeed;

class JenisPelayananSeeder extends AbstractSeed
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
        $table = $this->table('jenis_pelayanan');
        $table->insert([
            [
                "nama_layanan" => "Pendaftaran",
                "kode_layanan" => "A",
            ],
            [
                "nama_layanan" => "Informasi",
                "kode_layanan" => "A",
            ],
            [
                "nama_layanan" => "E-Court",
                "kode_layanan" => "A",
            ],
            [
                "nama_layanan" => "Pembayaran",
                "kode_layanan" => "B",
            ],
            [
                "nama_layanan" => "Posbakum",
                "kode_layanan" => "C",
            ],
            [
                "nama_layanan" => "Produk",
                "kode_layanan" => "D",
            ],
        ])
            ->save();
    }
}
