<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @return array
     */
    protected $fillable = ['author_id', 'category_id', 'publish', 'title', 'open', 'description'];

    /**
     * The question author relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
