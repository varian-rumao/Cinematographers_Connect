<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\Article;
use App\Models\Document; // or any other models you may need
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function show($type, $id)
    {
        switch ($type) {
            case 'works':
                $item = UserProfile::findOrFail($id);
                return view('works.show', compact('item'));

            case 'articles':
                $item = Article::findOrFail($id);
                return view('articles.show', compact('item'));

            case 'documents':
                $item = Document::findOrFail($id);
                return view('documents.show', compact('item'));

            default:
                abort(404);
        }
    }
}