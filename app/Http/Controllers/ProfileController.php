<?php

namespace App\Http\Controllers;

use App\Country;
use App\Petitions;
use App\Organization;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * The user model for the database.
     *
     * @var User
     */
    private $user;

    /**
     * The country model for the database.
     *
     * @var Country
     */
    private $countries;

    /**
     *¨The organization model for the database.
     *
     * @var Organization
     */
    private $organization;

    /**
     * ProfileController constructor.
     *
     * @param User          $user
     * @param Country       $countries
     * @param Organiszation $organization
     */
    public function __construct(User $user, Country $countries, Organization $organization)
    {
        $this->user         = $user;
        $this->countries    = $countries;
        $this->organization = $organization;
    }

    /**
     * Show the organization profile for the platform members.
     *
     * @param  integer $organizationId The id from the organization in the database.
     * @return mixed
     */
    public function organization($organizationId)
    {
        try {
            $data['organization'] = $this->organization->findOrFail($organizationId);
            $data['title']        = $data['organization']->title;

            return view('account.profile-organization', $data);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return app()->abort(404);
        }
    }

    /**
     * Show the settings page for the authencated user.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userSettings()
    {
        $data['user']  = $this->user->where('id', '=', auth()->user()->id)
            ->with(['organizations'])
            ->firstOrFail();

        $data['title'] = $data['user']->username;
        $data['countries'] = $this->countries->select(['id', 'long_name'])->get();

        return view('account.profile-user', $data);
    }

    /**
     * Display a user profile to the other users.
     *
     * @param  integer $userId The user id in the database.
     * @return mixed
     */
    public function members($userId)
    {
        try {
            $data['userPetitions']  = Petitions::where('author_id', '=', $userId);
            $data['user']           = $this->user->with(['organizations'])->findOrFail($userId);
            $data['title']          = $data['user']->name;

            return view('account.profile-members', $data);
        } catch(ModelNotFoundException $modelNotFoundException) {
            return app()->abort(404);
        }
    }
}
