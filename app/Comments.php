<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comments
 *
 * @package App
 */
class Comments extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @return array
     */
    protected $fillable = ['comment', 'author_id'];

    /**
     * Get the author information for the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the comments on an helpdesk question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function suppportQuestion()
    {
        return $this->belongsToMany(Questions::class)->withTimestamps();
    }
}
