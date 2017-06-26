<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * The user database model.
     *
     * @var User
     */
    private $user;

    /**
     * UsersController constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->middleware('lang');

        $this->user = $user;
    }

    /**
     * Get the user management index.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['title']      = 'User management';
        $data['usersCount'] = $this->user->count();
        $data['users']      = $this->user->paginate(25);

        return view('users.index', $data);
    }

    /**
     * Block a user in the system.
     *
     * @param  integer $userId The user id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block($userId)
    {
        return back(302);
    }

    /**
     * Unblock a user in the system.
     *
     * @param  integer $userId The user id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblock($userId)
    {
        return back(302);
    }

    /**
     * Delete a user in the system.
     *
     * @param  integer $userId The user id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($userId)
    {
        return back(302);
    }
}
