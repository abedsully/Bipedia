<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function view()
    {
        return view('article.addArticle');
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'title' => 'required|min:20|max:200',
            'content' => 'required|min:20|max:2000',
        ]);

        $filename = NULL;
        if($request->file('image') != NULL) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $originalName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = $originalName.'_'.$extension;
            $request->file('image')->storeAs('/public/images', $filename);
        }

        Article::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'date' => now(),
            'image' => $filename
        ]);

        return redirect('/dashboard')->with('success', 'Article has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $articles = Article::all();

        return view('main.dashboard', compact('articles'));
    }

    public function showDetail($id) 
    {
        $article = Article::find($id);
        return view('article.articleDetails', compact('article'));  
    }

    public function search(Request $request){
        $articles = Article::query();
    
        if ($request->has('search')) {
            $searchTerm = $request->search;
    
            $articles->where(function ($query) use ($searchTerm) {
                $query->where('title', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                          $userQuery->where('username', 'LIKE', '%' . $searchTerm . '%');
                      });
            });
        }
    
        $articles = $articles->paginate();
        $articles = $articles->reverse();
    
        return view('main.dashboard', compact('articles'));
    }

    public function showArticle(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $articles = Article::where('user_id', $user->id)->get();

        $articles = $articles->reverse();
    
        return view('article.myArticle', compact('user', 'articles'));
    }

    public function editArticle($id)
    {
        $article = Article::findOrFail($id);
        return view('article.editArticle', compact('article'));
    }

    public function updateArticle(Request $request, $id)
    {

        $validasi = $request->validate([
            'title' => 'required|min:20|max:200',
            'content' => 'required|min:20|max:2000',
        ]);


        Article::findorFail($id)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/article-details/' . $id)->with('success', 'Article has been updated successfully!');
    }

    public function deleteArticle($id){
        $article = Article::findOrFail($id);

        $userId = $article->user->id;

        Article::destroy($id);

        return redirect('/my-article/' . $userId)->with('success', 'Article has been deleted successfully!');
    }
}
