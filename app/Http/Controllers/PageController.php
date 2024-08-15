<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $images = [
            '/images/1.jpg', 
            '/images/2.jpg',
            '/images/3.jpg',
        ];

        return view('home', compact('images'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $results = [
            'Sample Result 1',
            'Sample Result 2',
            'Sample Result 3',
        ];

        return view('search', compact('query', 'results'));
    }

    // Other methods
    public function works()
    {
        return view('works');
    }

    public function stories()
    {
        return view('stories');
    }

    public function gallery()
    {
        return view('gallery');
    }

    public function contact()
    {
        return view('contact');
    }
}
