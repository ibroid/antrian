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
                "template" => "Petugas sidang dipanggil ke ruang sidang {ruang_sidang}."
            ],
            [
                "judul" => "istirahat-sidang",
                "template" => "Persidangan di {ruang_sidang} sedang istirahat. Para pihak diperkenankan meninggalkan ruang tunggu persidangan."
            ],
            [
                "judul" => "istirahat-pelayanan",
                "template" => "Pelayanan kami sedang istirahat, dan akan dilanjutkan setelah pukul satu."
            ],
            [
                "judul" => "semua-pihak-ke-ruang-tunggu",
                "template" => "Para pihak dari {pihak_satu} {condition_pihak_dua}, dipanggil masuk ke ruang tunggu persidangan."
            ],
            [
                "judul" => "semua-pihak-ke-ruang-sidang",
                "template" => "Para pihak dari {pihak_satu} {condition_pihak_dua}, dipanggil masuk ke dalam ruang sidang {ruang_sidang}."
            ],
            [
                "judul" => "pihak-ke-ruang-tunggu",
                "template" => "Pihak atas nama {nama_pihak}, dipanggil masuk ke ruang tunggu persidangan."
            ],
            [
                "judul" => "pihak-ke-ruang-sidang",
                "template" => "Pihak atas nama {nama_pihak}, dipanggil masuk ke ruang sidang {ruang_sidang}."
            ],
            [
                "judul" => "perkara-diskors",
                "template" => "Perkara atas nama {pihak_satu} {condition_pihak_dua} telah diskors. Silahkan tunggu untuk dipanggil kembali"
            ],
            [
                "judul" => "saksi-saksi-ke-ruang-tunggu",
                "template" => "Saksi saksi dari pihak {pihak_satu} {condition_pihak_dua}, dipanggil masuk ke ruang tunggu persidangan."
            ],
            [
                "judul" => "saksi-saksi-ke-ruang-sidang",
                "template" => "Saksi saksi dari pihak {pihak_satu} {condition_pihak_dua}, dipanggil masuk ke ruang sidang {ruang_sidang}."
            ],

        ];

        $roles = $this->table('pengumuman');
        $roles->insert($data)
            ->save();
    }
}
