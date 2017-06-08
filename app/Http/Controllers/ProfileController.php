<?php

namespace App\Http\Controllers;

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
     * ProfileController constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
