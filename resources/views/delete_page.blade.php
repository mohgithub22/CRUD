@extends('layouts.master')






@section('f')   

<h2>delete-article</h2>  
@foreach ($articles as $article )
<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>operation</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$article->id}}</td>
            <td>{{$article->title}}</td>
            <form method="post" action="/admin/articles/{{$article->id}}">
                @csrf
                @method('delete')
                <button class="btn btn-danger">delete</button>
            </form>
        </tr>
    </tbody>
</table>
@endforeach

@endsection