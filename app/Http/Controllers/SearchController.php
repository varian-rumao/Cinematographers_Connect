<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\Article;
use App\Models\Work;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query || str_word_count($query) < 1) {
            return redirect()->back()->with('error', 'Please enter a keyword to search.');
        }

        $results = [];

        // Search User Profiles
        $profiles = UserProfile::where('business_email', 'LIKE', "%{$query}%")
            ->orWhere('mobile_number', 'LIKE', "%{$query}%")
            ->orWhere('location', 'LIKE', "%{$query}%")
            ->orWhere('other_details', 'LIKE', "%{$query}%")
            ->get();

        foreach ($profiles as $profile) {
            $results[] = [
                'id' => $profile->id,
                'title' => $profile->business_email,
                'type' => 'works', // Add type 'works' to distinguish in the view
            ];
        }

        // Search Works
        $works = Work::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        foreach ($works as $work) {
            $results[] = [
                'id' => $work->id,
                'title' => $work->title ?? 'Work Item',
                'type' => 'works', // Add type 'works' for works items
            ];
        }

        // Search Articles
        $articles = Article::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->orWhere('keywords', 'LIKE', "%{$query}%")
            ->get();

        foreach ($articles as $article) {
            $results[] = [
                'id' => $article->id,
                'title' => $article->title,
                'type' => 'articles', // Add type 'articles' for article items
            ];
        }

        return view('search_results', compact('results', 'query'));
    }
}
