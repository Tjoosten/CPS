<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 *
 * @package App
 */
class Country extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['short_name', 'long_name'];
}
