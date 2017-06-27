<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('type_of_question')->insert([
            ['type' => 1, 'en_name' => 'single_choice', 'cn_name' => '单选'],
            ['type' => 2, 'en_name' => 'multi_choice', 'cn_name' => '多选'],
            ['type' => 3, 'en_name' => 'fill_in_blank', 'cn_name' => '填空'],
            ['type' => 4, 'en_name' => 'matrix_single', 'cn_name' => '矩阵单选题'],
            ['type' => 5, 'en_name' => 'matrix_scale', 'cn_name' => '矩阵量表题'],
            ['type' => 6, 'en_name' => 'paragraph_description', 'cn_name' => '段落说明'],
            ['type' => 7, 'en_name' => 'multi_blank', 'cn_name' => '多项填空题']
        ]);

        DB::table('users')->insert([
           ['name' => 'meezao_root', 'email' => 'meezao_root@meezao.com', 'password' => bcrypt('123456')],
           ['name' => 'root_meezao', 'email' => 'root_meezao@meezao.com', 'password' => bcrypt('123456')],
           ['name' => 'mshucheng', 'email' => 'mshucheng@meezao.com', 'password' => bcrypt('123456')],
           ['name' => 'moushucheng', 'email' => 'mshucheng@qq.com', 'password' => bcrypt('123456')],
        ]);
    }
}
