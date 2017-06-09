<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

/**
 * Class AccountController
 *
 * @package App\Http\Controllers
 */
class AccountController extends Controller
{
    /**
     * The users model in the database.
     *
     * @var User
     */
    private $user;

    /**
     * AccountController constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->middleware('auth');

        $this->user = $user;
    }

    /**
     * Update the user his password.
     *
     * @param  Request $input The user input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $input)
    {
        $this->validate($input, ['password' => 'required|string|min:6|confirmed']);
        
        if ($this->user->find(auth()->user()->id)->update($input->except(['_token', 'password_confirmation']))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Your password has been updated.');
        }

        return back(302);
    }
}
