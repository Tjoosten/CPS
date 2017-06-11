<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportReasonSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // ['lang_key' => '', 'name' => '', 'description' => ''],
            ['lang_key' => 'nl', 'name' => "I don't like this comment"],
            ['lang_key' => 'nl', 'name' => 'Infinges on my rights'],
            ['lang_key' => 'nl', 'name' => 'Abusive of hateful'],
            ['lang_key' => 'nl', 'name' => 'Inappropriate multimedia'],
            ['lang_key' => 'nl', 'name' => 'Misleading to spam'],
            ['lang_key' => 'nl', 'name' => 'Harmful to children'],
            ['lang_key' => 'nl', 'name' => 'Violence, suicide, or self harm'],
            ['lang_key' => 'nl', 'name' => 'Impersonation']
        ];

        // Data table operations.
        $table = DB::table('report_reasons');
        $table->delete();
        $table->insert($data);
    }
}
