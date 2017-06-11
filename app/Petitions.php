<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Petitions
 *
 * @package App
 */
class Petitions extends Model
{
    /**
     * The mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'title', 'description'];

    /**
     * The author data for the petition.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * The categories relationship for the petitions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Categories::class)->withTimestamps();
    }
}
