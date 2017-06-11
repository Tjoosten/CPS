<?php

namespace App\Http\Controllers;

use App\Country;
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
     * ProfileController constructor.
     *
     * @param User $user
     * @param Country $countries
     */
    public function __construct(User $user, Country $countries)
    {
        $this->user      = $user;
        $this->countries = $countries;
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
            $data['user']  = $this->user->with(['organizations'])->findOrFail($userId);
            $data['title'] = $data['user']->name;

            return view('account.profile-members', $data);
        } catch(ModelNotFoundException $modelNotFoundException) {
            return app()->abort(404);
        }
    }
}
