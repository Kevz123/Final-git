<?php

namespace App\Http\Controllers;

use App\Models\CreateNews;
use Illuminate\Http\Request;


class NewsController extends Controller
{
    public function index()
    {
        $news = CreateNews::all();
        return view('news.news', compact('news'));
    }

    public function create()
    {
        return view('news.createnews');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'club_name' => 'required|string|max:255',
            'status' => 'required|in:upcoming,completed',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        CreateNews::create([
            'title' => $request->title,
            'club_name' => $request->club_name,
            'status' => $request->status,
            'description' => $request->description,
            'date' => $request->date,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('news')->with('success', 'Event news successfully submitted!');
    }

    public function destroy($id)
    {
        // Find the news by ID and delete it
        $news = CreateNews::findOrFail($id);
        $news->delete();

        // Redirect back with a success message
        return redirect()->route('news')->with('success', 'News item removed successfully.');
    }

}
