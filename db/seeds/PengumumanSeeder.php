<?php


use Phinx\Seed\AbstractSeed;

class PengumumanSeeder extends AbstractSeed
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
        $data = [
            [
                "judul" => "pembukaan-sidang",
                "template" => "Dengan mengucap bissmillahhirrahmannirrahim, Persidangan di {ruang_sidang} akan dimulai."
            ],
            [
                "judul" => "panggil-petugas",
                "template" => "Petugas sidang dipanggil ke {ruang_sidang}."
            ],
            [
                "judul" => "istirahat-sidang",
                "template" => "Persidangan di {ruang_sidang} sedang istirahat. Para pihak diperkenankan meninggalkan ruang tunggu sidang."
            ],
            [
                "judul" => "istirahat-pelayanan",
                "template" => "Pelayanan kami sedang istirahat, dan akan dilanjutkan setelah pukul satu."
            ],
        ];

        $roles = $this->table('pengumuman');
        $roles->insert($data)
            ->save();
    }
}
