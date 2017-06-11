<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests\QuestionValidator;
use App\Questions;
use Illuminate\Http\Request;

/**
 * Class QuestionsController
 *
 * @package App\Http\Controllers
 */
class QuestionsController extends Controller
{
    // TODO: Build up the Question validator class. (create)
    // TODO: Implement the question validator in the view. (create)

    /**
     * The categories db model instance.
     *
     * @var Categories
     */
    private $categories;
    /**
     * @var Questions
     */
    private $questions;

    /**
     * QuestionsController constructor.
     *
     * @param Categories $categories
     * @param Questions  $questions
     */
    public function __construct(Categories $categories, Questions $questions)
    {
        $this->middleware('auth');

        $this->categories = $categories;
        $this->questions  = $questions;
    }

    /**
     * Index view for the questions helpdesk.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['title']  = 'Questions index';
        $data['all']    = $this->questions->count();
        $data['open']   = $this->questions->where('open', 'Y')->count();
        $data['closed'] = $this->questions->where('open', 'N')->count();

        return view('questions.index', $data);
    }

    /**
     * Create view for a new question.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data['title']      = 'Ask your question.';
        $data['categories'] = $this->categories->where('module', '=', 'helpdesk-categories')->get();

        return view('questions.create', $data);
    }

    /**
     * Get the questions for the authencated user.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user()
    {
        $data['title']     = 'Questions' . auth()->user()->id;
        $data['questions'] = $this->questions->where('author_id', auth()->user()->id)
            ->with(['categories'])
            ->paginate(30);

        return view('questions.user', $data);
    }

    /**
     * Store a new question in the database.
     *
     * @param  QuestionValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuestionValidator $input)
    {
        if ($this->questions->create($input->except(['_token']))) { // CREATE = OK
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Your question has been stored.');
        }

        return back(302);
    }
}
