<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    protected $commentmodel;

    public function __construct(Comment $cate)
    {
        // $this->middleware('auth:admin');
        $this->commentmodel = $cate;
    }
    public function index()
    {
        $comments = Comment::select('id', 'name', 'title')->latest()->paginate(10);
        return view('backend.commetns.index', compact('comments'));
    }

    public function show($id)
    {
        $comments = Comment::find($id);
        $this->authorize('create', Comment::class);
        return view('backend.commetns.show', compact('comments'));
    }
    public function destroy($id)
    {
        $comments = Comment::find($id);
        $comments->delete();
        return redirect()->back();
    }
    public function approve($id)
    {
        $this->authorize('update', Comment::class);
        $comments = Comment::findOrFail($id);
        $comments->update([
            'isApprove' => !$comments->isApprove
        ]);

        return back();
    }
}
