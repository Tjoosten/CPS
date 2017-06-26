<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountInfoValidator;
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
        $this->middleware('lang');

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
        
        if ($this->user->find(auth()->user()->id)->update(bcrypt($input->password))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Your password has been updated.');
        }

        return back(302);
    }

    /**
     * Update the account information.
     *
     * @param  AccountInfoValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfo(AccountInfoValidator $input)
    {
        if ($this->user->find(auth()->user()->id)->update($input->except(['_token']))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Your account information has been updated');
        }

        return back(302);
    }
}
