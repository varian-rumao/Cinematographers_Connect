<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Photo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function manageUsers()
    {
        $users = User::all();
        return view('manage_users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('manage.users')->with('success', 'User deleted successfully.');
    }

    public function approveArticle(Article $article)
    {
        $article->status = 'approved';
        $article->save();
        return redirect()->route('articles.index')->with('success', 'Article approved successfully.');
    }

    public function rejectArticle(Article $article)
    {
        $article->status = 'rejected';
        $article->save();
        return redirect()->route('articles.index')->with('success', 'Article rejected successfully.');
    }

    public function deletePhoto(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('gallery.index')->with('success', 'Photo deleted successfully.');
    }
}
