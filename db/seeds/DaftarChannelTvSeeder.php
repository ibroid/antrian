<?php


use Phinx\Seed\AbstractSeed;

class DaftarChannelTvSeeder extends AbstractSeed
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
        $table = $this->table('daftar_channel_tv');
        $table->insert([
            [
                "nama_channel" => "TV One",
                "url" => "https://www.youtube.com/embed/yNKvkPJl-tg?si=AJHk-H1tdbPSQwS7",
            ],
            [
                "nama_channel" => "Kompas TV",
                "url" => "https://www.youtube.com/embed/DOOrIxw5xOw?si=vYchAp7vVe6KSU_w",
            ],
            [
                "nama_channel" => "Metro TV",
                "url" => "https://www.youtube.com/embed/XKueVSGTk2o?si=iHU8FRYVdNDuVsyN",
            ],
            [
                "nama_channel" => "Spongebob",
                "url" => "https://www.youtube.com/embed/-AzqVQY32-Y?si=lkCY1Oip_o_nPzLq",
            ],
            [
                "nama_channel" => "Mekkah Live",
                "url" => "https://www.youtube.com/embed/CobDSv8cbCY?si=y6ZamOI3MHB24788",
            ]
        ])->save();
    }
}
