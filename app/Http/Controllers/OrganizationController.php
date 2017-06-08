<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationValidator;
use App\Organization;
use Illuminate\Http\Request;

/**
 * Class OrganizationController
 *
 * @package App\Http\Controllers
 */
class OrganizationController extends Controller
{
    /**
     * @var Organization
     */
    private $organzation;

    /**
     * OrganizationController constructor.
     *
     * @param Organization $organzation
     */
    public function __construct(Organization $organzation)
    {
        $this->organzation = $organzation;
    }

    /**
     * Create view for a new organization.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data['title'] = 'Nieuwe organisatie';
        return view('organizations.create', $data);
    }

    /**
     * Store a new organization in the system
     *
     * @param  OrganizationValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrganizationValidator $input)
    {
        if ($organization = $this->organzation->create($input->except(['_token']))) { // Create = OK
            if ($input->file('avatar')) { // There is an avatar given
                // TODO: write method to shrink the image tp 75x75

                $path = $input->file('avatar')->store('avatars');
                $this->organzation->find($organization->id)
                    ->update(['avatar' => $path]); // Save avatar to the database.
            }

            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The organization has been created');
        }

        return back(302);
    }
}
