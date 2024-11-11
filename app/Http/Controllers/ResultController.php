<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\Work;
use App\Models\Article;

class ResultController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $profileResults = UserProfile::where('business_email', 'like', '%' . $query . '%')
            ->orWhere('location', 'like', '%' . $query . '%')
            ->get();
        
        $articleResults = Article::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->orWhere('keywords', 'like', '%' . $query . '%')
            ->get();

        $staticContent = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'About Us', 'url' => route('about')],
            ['title' => 'Contact Us', 'url' => route('contact')],
            ['title' => 'Gallery', 'url' => route('gallery.index')],
            ['title' => 'Articles', 'url' => route('articles.index')],
            ['title' => 'Manage Profile', 'url' => auth()->check() ? route('profile.edit', auth()->user()->id) : null],
            ['title' => 'New Article', 'url' => auth()->check() ? route('articles.create') : null],
        ];

        $staticResults = array_filter($staticContent, function ($content) use ($query) {
            return stripos($content['title'], $query) !== false;
        });

        return view('results', [
            'query' => $query,
            'profileResults' => $profileResults,
            'articleResults' => $articleResults,
            'staticResults' => $staticResults,
        ]);
    }
}
