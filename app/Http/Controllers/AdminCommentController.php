<?php

namespace App\Http\Controllers;

use App\Models\VisitorComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminCommentController extends Controller
{
    /**
     * Paparkan senarai semua komen untuk pengurusan admin.
     */
    public function index(): View
    {
        $comments = VisitorComment::query()
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.comments.index', [
            'comments' => $comments,
        ]);
    }

    /**
     * Padam komen.
     */
    public function destroy(VisitorComment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()
            ->route('admin.comments.index')
            ->with('success', 'Komen berjaya dipadam.');
    }
}