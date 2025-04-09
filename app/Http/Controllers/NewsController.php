<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('news.index', compact('news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('news', 'public') : null;

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'link' => $request->link,
        ]);

        return redirect()->back()->with('success', 'Noticia añadida correctamente.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return redirect()->back()->with('success', 'Noticia eliminada.');
    }

    public function sort(Request $request)
{
    foreach ($request->orden as $item) {
        \App\Models\News::where('id', $item['id'])->update(['position' => $item['position']]);
    }

    return response()->json(['status' => 'ok']);
}

}
