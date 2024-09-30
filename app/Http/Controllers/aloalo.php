<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class aloalo extends Controller
{

    public function mainpagearticle()
    {
        $ar = Article::all();
        return view('mainindex', ['articles' => $ar]);
    }



    public function articlecreatepost(ArticleRequest $request)
    {
        // validator::make($request->all() ,['title'=>'required|min:10|max:50' ,'body'=>'required'])->validate();


        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator);

        // }
        Article::create(['title' => request('title'), 'body' => request('body'),]);
        return redirect('admin/articles/create');
    }


    public function Update(Article $article)
    {

        return view('updatearticle', ["article" => $article]);
    }
    public function PutUpdate($id, Request $request)
    {
        $request->validate(['title' => 'required|min:10|max:50', 'body' => 'required']);
        // validator::make($request->all() ,['title'=>'required|min:10|max:50' ,'body'=>'required'])->validate();
        $article = Article::findOrFail($id);
        $article->update(['title' => request('title'), 'body' => request('body')]);

        // $user = auth()->user();
        // $user->article()->create(['title'=> request('title'),'body'=> request('body') ,'user_id'=>request('id')]);
        return redirect('admin/articles/{{$article->id}}/update');
    }

    public function GetAllArticles()
    {
        $article = Article::all();
        return view('delete_page', compact('article'));
    }

    public function DeleteArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return back();
    }


    public function SinglePostView(Article $article)
    {
        dd(request()->cookie('name'));
        return view('SinglePost', ['singlearticle' => $article]);
    }
    public function AboutUs()
    {
        
        cookie()->queue('name' ,'reza' ,60);
        cookie()->queue(cookie('name' ,'reza'));
        cookie()->queue(cookie()->forget('name'));
        return view('AboutUsPage',);
    }
}
