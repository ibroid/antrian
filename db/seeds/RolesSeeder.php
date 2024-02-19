<?php


use Phinx\Seed\AbstractSeed;

class RolesSeeder extends AbstractSeed
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
                "role_name" => "Admin",
            ],
            [
                "role_name" => "Petugas Sidang",
            ],
            [
                "role_name" => "Petugas PTSP",
            ],
            [
                "role_name" => "Petugas Pegawai",
            ],
            [
                "role_name" => "Petugas HAKIM",
            ],
        ];

        $roles = $this->table('roles');
        $roles->insert($data)
            ->save();
    }
}
