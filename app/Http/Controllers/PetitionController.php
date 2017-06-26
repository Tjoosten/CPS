<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Country;
use App\Http\Requests\PetitionValidator;
use App\Petitions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class PetitionController
 *
 * @package App\Http\Controllers
 */
class PetitionController extends Controller
{
    // TODO: Build up the validator.
    // TODO: Implement the validation on the create view (form).
    // TODO: Implement form field for the total signatures needed on the petition create.

    /**
     * The petitions model for the database.
     *
     * @var Petitions
     */
    private $petition;

    /**
     * The catefories model.
     *
     * @var Categories
     */
    private $categories;

    /**
     * The country model for the database.
     *
     * @var Country
     */
    private $country;

    /**
     * PetitionController constructor.
     *
     * @param Petitions   $petition     The petitions  database model.
     * @param Categories  $categories   The categories database model.
     * @param Country     $country      The country database instance.
     */
    public function __construct(Petitions $petition, Categories $categories, Country $country)
    {
        $this->middleware('auth')->only(['create', 'store']);
        $this->middleware('lang');

        $this->petition   = $petition;
        $this->categories = $categories;
        $this->country    = $country;
    }

    /**
     * Display all the petitions in the system.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $modelBase = $this->petition->with(['author', 'categories']);

        $data['title']      = 'Petitions';
        $data['petitions']  = $modelBase->paginate(15);
        $data['categories'] = $this->categories->where('module', 'petition')->inRandomOrder()->limit(15)->get();
        ;
        $data['recent']     = $modelBase->orderBy('created_at', 'DESC')->paginate(15);
        $data['featured']   = []; // TODO: Build query
        $data['popular']    = []; // TODO: Build query

        return view('petitions.index', $data);
    }

    /**
     * Show a specific petition.
     *
     * @param  integer $petitionId The petition id in the database.
     * @return Mixed
     */
    public function show($petitionId)
    {
        try {
            $data['petition']  = $this->petition->with(['author'])->findOrFail($petitionId);
            $data['countries'] = $this->country->all();
            $data['title']     = $data['petition']->title;

            return view('petitions.show', $data);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return app()->abort(404);
        }
    }

    /**
     * Create view for a new petition.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data['title'] = 'Create new petition';
        return view('petitions.create', $data);
    }

    /**
     * Create a new petition in the database.
     *
     * @param  PetitionValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PetitionValidator $input)
    {
        $categories  = explode(',', $input->get('categories')); // Break up the text into an array.
        $newPetition = $this->petition->create($input->except(['_token', 'categories']));

        foreach ($categories as $category) { // Create ans assign the categories.
            $leftTrim   = ltrim($category);  // Trim the whitespace on the left side.
            $dbCategory = rtrim($leftTrim);  // Trim the whitespace on the right side.

            $insert = $this->categories->firstOrCreate(['name' => $dbCategory, 'module' => 'petition']);
            $this->petition->find($newPetition->id)->categories()->attach($insert->id);
        }

        session()->flash('class', 'alert alert-success');
        session()->flash('message', 'The petition has been created');

        return back(302);
    }

    /**
     * Search for a specific petition.
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
    }

    /**
     * Edit a specific petition.
     *
     * @param  integer $petitionId The petition id in the database.
     * @return mixed
     */
    public function edit($petitionId)
    {
        try {
            $data['petition'] = $this->petition->findOrFail($petitionId);

            if ($data['petition']->author_id === auth()->user()->id) { // User authorization check.
               $data['title']    = "Edit {$data['petition']->title}";

                return view('petitions.edit', $data);
            }
        } catch (ModelNotFoundException $modelNotFoundException) {
            return app()->abort(404);
        }
    }

    /**
     * Update an petition in the system.
     *
     * @param  PetitionValidator $input
     * @param  string            $petitionId
     * @return mixed
     */
    public function update(PetitionValidator $input, $petitionId)
    {
        try {
            $petition = $this->petition->findOrfail($petitionId);

            if ($petition->update($input->except(['_token']))) { // Update petition = OK
                session()->flash('class', 'alert alert-success');
                session()->flash('message', 'Your petition has been updated.');
            }

            return back(302);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return app()->abort(404);
        }
    }

    /**
     * Delete a petition in the system.
     *
     * @param  integer $petitionId The petition id in the system.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($petitionId)
    {
        try { // Try to find the petition in the database.
            $petition = $this->petition->findOrFail($petitionId);

            if ($petition->author_id === auth()->user()->id && $petition->delete()) { // The author is the current logged in user.
                $petition->categories()->sync([]);

                // Flash output
                session()->flash('class', 'alert alert-success');
                session()->flash('message', 'The petition has been deleted.');
            }

            return redirect()->route('petitions.index');
        } catch (ModelNotFoundException $modelNotFoundException) {
            return app()->abort(404);
        }
    }
}
