<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * Mass-assign fields for the database column.
     *
     * @var array
     */
    protected $fillable = ['name', 'module'];
}
