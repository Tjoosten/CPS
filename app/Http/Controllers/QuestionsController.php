<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Comments;
use App\Http\Requests\QuestionCommentValidator;
use App\Http\Requests\QuestionValidator;
use App\Questions;
use App\ReportReasons;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * The questions database model.
     *
     * @var Questions
     */
    private $questions;

    /**
     * The reaport reasons database model.
     * @var ReportReasons
     */
    private $reasons;

    /**
     * QuestionsController constructor.
     *
     * @param Categories    $categories
     * @param Questions     $questions
     * @param ReportReasons $reasons
     */
    public function __construct(Categories $categories, Questions $questions, ReportReasons $reasons)
    {
        $this->middleware('auth');

        $this->categories = $categories;
        $this->questions  = $questions;
        $this->reasons = $reasons;
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
     * Show a specific petition in the system.
     *
     * @param  integer $questionId The question in the database.
     * @return mixed
     */
    public function show($questionId)
    {
        try {
            $data['question']      = $this->questions->with(['comments.author'])->findOrFail($questionId);
            $data['reportReasons'] = $this->reasons->all();
            $data['title']         = $data['question']->title;

            return view('questions.show', $data);
        } catch (ModelNotFoundException $exception) {
            return app()->abort(404); // HTTP 404 => NOT FOUND.
        }
    }

    /**
     * Return the id of a question with json - AJAX
     *
     * @param  int $questionId The question id in the database.
     * @return string
     */
    public function getById($questionId)
    {
        try {
            $question = $this->questions->select(['id'])->findOrFail($questionId);
            return json_encode($question);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return json_encode(['404 - Resource not found.']);
        }
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

    /**
     * Store a new comment to the question.
     *
     * @param  QuestionCommentValidator $input
     * @param  Comments                 $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(QuestionCommentValidator $input, Comments $comment)
    {
        $filter = ['_token', 'question_id'];

        if ((int) $input->author_id === auth()->user()->id) { // The authencated user is the same as the user in the form.
            if ($reaction = $comment->create($input->except($filter))) { // Try to insert the comment in the database.
                $comment->find($reaction->id)->suppportQuestion()->attach($input->question_id);

                session()->flash('class', 'alert alert-success');
                session()->flash('message', 'Your comment has been stored.');
            }
        }

        return back(302);
    }
}
