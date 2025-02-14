<?php


use Phinx\Seed\AbstractSeed;

class RunningTextContentSeeder extends AbstractSeed
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
        $table = $this->table('running_text_content');
        $table->insert([
            [
                "content" => "Selamat Datang di Web Antrian Online Pengadilan XXXX XXXX XXXX. Hari kerja dari senin sampai jumat pukul 08.00 - 17.00 WIB."
            ],
            [
                "content" => "Pastikan anda melihat antrian yang sedang berjalan. Silahkan baca informasi terkait antrian pada tiket antrian anda."
            ],
            [
                "content" => "Untuk mengakses pelayanan lebih lengkap silahkan scan kode QR yang tertera pada tiket antrian anda."
            ]
        ])->save();
    }
}
