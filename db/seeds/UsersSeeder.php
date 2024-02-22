<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
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
        $pass = $_ENV["DEBUG"] ? "admin123" : "kuyabatok";
        $data = [
            [
                "sipp_user_id" => 1,
                "identifier" => "admin",
                "salt" => "g17i09n15R17",
                "password" => password_hash($pass . "g17i09n15R17", PASSWORD_BCRYPT),
                "name" => "Admin Imal",
                "role_id" => 1
            ]
        ];

        $users = $this->table('users');
        $users->insert($data)
            ->save();
    }
}
