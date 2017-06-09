<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // ['name' => '', 'module' = ''],
            ['name' => 'I found a bug', 'module' => 'helpdesk-categories']
        ];

        $table = DB::table('categories');
        $table->delete();
        $table->insert($data);
    }
}
