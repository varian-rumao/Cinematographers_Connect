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

        $users = User::where('status', 'active')->get();
        return view('admin.manage_users', compact('users'));
    }

    public function deactivateUser($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Deactivate the user by setting 'status' to 'inactive'
        $user->status = 'inactive';
        $user->save();

        // Redirect back to the manage users page with a success message
        return redirect()->route('admin.manageUsers')->with('success', 'User deactivated successfully.');
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

    public function deletePhoto($id)
    {
        // Find the work photo by its ID
        $photo = Work::find($id);

        if ($photo) {
            // Optionally, delete the physical file if needed
            // Storage::delete('path_to_photo_in_storage');

            // Delete the photo record from the database
            $photo->delete();

            // Redirect back with success message
            return redirect()->route('admin.managePhotos')->with('success', 'Photo deleted successfully.');
        } else {
            // Return error if photo not found
            return redirect()->route('admin.managePhotos')->with('error', 'Photo not found.');
        }
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
