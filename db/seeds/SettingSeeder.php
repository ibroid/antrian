<?php


use Phinx\Seed\AbstractSeed;

class SettingSeeder extends AbstractSeed
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
        $table = $this->table('settings');
        $table->insert([
            [
                "key" => "satker_name",
                "value" => "PENGADILAN AGAMA JAKARTA UTARA",
                "level" => "Admin",
                "description" => "Nama satuan kerja yang menggunakan aplikasi ini."
            ],
            [
                "key" => "jam_ambil_antrian_ptsp",
                "value" => 8,
                "level" => "Admin",
                "description" => "Batas ambil antrian pelayanan"
            ],
            [
                "key" => "jam_ambil_antrian_sidang",
                "value" => 10,
                "level" => "Admin",
                "description" => "Batas ambil antrian persidangan"
            ]
        ])->save();
    }
}
