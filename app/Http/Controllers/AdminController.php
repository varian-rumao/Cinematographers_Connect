<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Models\Work;

class AdminController extends Controller
{
    // Manage Users
    public function manageUsers()
    {
        if (!auth()->user()->is_admin) {
            return redirect('/home')->with('error', 'You do not have admin access.');
        }

        $users = User::all();
        return view('admin.manage_users', compact('users'));
    }

    // Delete User
    public function deleteUser(User $user)
    {
        if (!auth()->user()->is_admin) {
            return redirect('/home')->with('error', 'You do not have admin access.');
        }

        $user->delete();
        return redirect()->route('admin.manageUsers')->with('success', 'User deleted successfully.');
    }

        public function managePhotos()
    {
        if (!auth()->user()->is_admin) {
            return redirect('/home')->with('error', 'You do not have admin access.');
        }

        // Fetch all work images
        $photos = Work::all();

        return view('admin.manage_photos', compact('photos'));
    }

    public function manageArticles()
    {
        if (!auth()->user()->is_admin) {
            return redirect('/home')->with('error', 'You do not have admin access.');
        }

        // Fetch only articles with a 'pending' status
        $articles = Article::where('status', 'pending')->get();

        return view('admin.manage_articles', compact('articles'));
    }

    public function approveArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->status = 'approved';
        $article->save();

        return redirect()->route('admin.manageArticles')->with('success', 'Article approved successfully.');
    }

    public function rejectArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->status = 'rejected';
        $article->save();

        return redirect()->route('admin.manageArticles')->with('success', 'Article rejected successfully.');
    }
}
