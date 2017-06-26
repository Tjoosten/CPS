<?php

namespace App\Http\Controllers;

use App\Petitions; 
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class: SignatureController 
 * 
 * @package App\Http\Controllers
 */
class SignatureController extends Controller
{
    // TODO: Register policy on the show method. So that the owner only can view the signatures. 

    /**
     * The petition database model. 
     *
     * @return Petition
     */ 
    private $petition;

    /**
     * The user database model. 
     * 
     * @return User
     */
    private $users;

    /**
     * SignatureController constructor 
     * 
     * @param  Petitions    $petition  The petition database instance.
     * @param  User         $user      The users database instance.
     * @return void
     */
    public function __construct(Petitions $petition, User $users) 
    {
        // $this->middelware('lang'); 
        $this->middleware('auth')->only(['index']);
        $this->middleware('lang');

        $this->petition = $petition;
        $this->users    = $users;
    }

    public function show($petitionId) 
    {
        try { // Try to find the petition. 
            $data['petition'] = $this->petition->findOrFail($petitionId); 
            $data['title']    = "Signatures: {$data['petition']->title}";
            
            return view('petitions.signature', $data);
        } catch (ModelNotFoundException $modelNotFoundException) { // Not found. 
            return app()->abort(404); // Resource not found.
        }
    }

    /**
     * Store a signature in the database. 
     *
     * @param  Requests\SignatureValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\SignatureValidator $input) 
    {
        $findUser = $this->users->where('email', $input->email);

        if ($findUser->count() === 1) { // The user already exists in the database. 
            $user = $findUser->first()->get(); // Get the first user that is located in the database. 
            $this->petition->find($input->petition_id)->signatures()->attach($user->id);

            // Info session 
            session()->flash('class', 'alert alert-success'); 
            session()->flash('message', 'Your signature has been stored.');
        } else { // No user found. So create a user login and store it to the signatures pivot. 
            if ($newUser = $this->users->create($input->except(['_token', 'petition_id']))) { // The new user login has been stored. 
                // Run the needed utilities
                $this->petition->find($input->petition_id)->signatures()->attach($newUser->id); // Attach the user to the signatures. 
                Auth::loginUsingId($newUser->id, true);                                         // Login the newly created user. 
                // TODO: Sent mailable with the password. 

                // Info session 
                session()->flash('class', 'alert alert-success');
                session()->flash('message', 'Your account has been created. And your signatyure is stored.');
            }
        }

        return back(302);
    }
}
