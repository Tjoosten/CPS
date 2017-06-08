<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Organization
 *
 * @package App
 */
class Organization extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['avatar', 'organisation_description', 'organisation_name'];

    /**
     * Member relation for an organization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
