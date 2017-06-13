<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationValidator;
use App\Organization;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

/**
 * Class OrganizationController
 *
 * @package App\Http\Controllers
 */
class OrganizationController extends Controller
{
    /**
     * The organization model.
     *
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
        $this->middleware('lang');

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
     * Display a specific organization and return 404 when no org. found.
     *
     * @param  integer $organizationId The organization id in the database.
     * @return mixed
     */
    public function show($organizationId)
    {
        try {
            $data['organization'] = $this->organzation->find($organizationId);
            $data['title']        = $data['organization']->name;

            return view('organizations.show', $data);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return app()->abort(404);
        }
    }

    /**
     * Store a new organization in the system
     *
     * @param  OrganizationValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrganizationValidator $input)
    {
        if ($organization = $this->organzation->create($input->except(['_token']))) { // Create AND Assign = OK
            $this->organzation->find($organization->id)->members()->attach(auth()->user()->id);

            if ($input->file('avatar')) { // There is an avatar given
                $image  = $input->file('avatar');
                $avatar = time() . '.' . $image->getClientOriginalExtension();
                $path   = public_path('avatars/organization/' . $avatar);

                Image::make($image->getRealPath())->resize(75, 75)->save($path);

                $this->organzation->find($organization->id)->update(['avatar' => $avatar]); // Save avatar to the database.
            }

            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The organization has been created');
        }

        return back(302);
    }
}
