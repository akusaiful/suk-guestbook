<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorComment;

class VisitorCommentController extends Controller
{
    public function index()
    {
        $comments = VisitorComment::with('event')
            ->latest()
            ->paginate(20);

        return view('admin.comments.index', compact('comments'));
    }

    public function destroy(VisitorComment $comment)
    {
        $comment->delete();

        return redirect()
            ->route('admin.comments.index')
            ->with('success', 'Komen berjaya dipadam.');
    }
}