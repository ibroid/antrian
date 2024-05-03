<?php


use Phinx\Seed\AbstractSeed;

class BannerPengumumanSeeder extends AbstractSeed
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
        $table = $this->table('banner_pengumuman');
        $table->insert([
            [
                'filename' => 'banner_1.jpg',
                'description' => 'Role Model',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'filename' => 'banner_2.jpg',
                'description' => 'Agen Perubahan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'filename' => 'banner_3.jpg',
                'description' => 'Panjar Biaya',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'filename' => 'banner_4.jpg',
                'description' => 'Radius Wilayah',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'filename' => 'banner_5.jpg',
                'description' => 'Kalung Pengunjung',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ])
            ->save();
    }
}
