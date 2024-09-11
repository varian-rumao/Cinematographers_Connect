<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('status', 'approved');

        if ($request->has('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%')
              ->orWhere('keywords', 'like', '%' . $request->keyword . '%');
        }

        $articles = $query->latest()->paginate(10);
        $latestArticles = Article::where('status', 'approved')->orderBy('created_at', 'desc')->take(5)->get();

        return view('articles.index', compact('articles', 'latestArticles'));
    }


    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'keywords' => 'nullable|string',
        ]);

        Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'keywords' => $validated['keywords'] ?? '',
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('articles.index')->with('success', 'Article submitted for review.');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    public function approve($id)
    {
        $article = Article::findOrFail($id);
        $article->update(['status' => 'approved']);
        return back()->with('success', 'Article approved successfully.');
    }

    public function reject($id)
    {
        $article = Article::findOrFail($id);
        $article->update(['status' => 'rejected']);
        return back()->with('success', 'Article rejected.');
    }
    
}
