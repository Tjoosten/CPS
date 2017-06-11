<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReportReasons
 *
 * @package App
 */
class ReportReasons extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @return array
     */
    protected $fillables = ['lang_key', 'name', 'description'];
}
