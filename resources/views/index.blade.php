@extends('layouts.master')






@section('f')
   

<h2>create article</h2>  
@if($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach( $errors->all() as $error)

           <li>{{$error}}</li>
        


      @endforeach
   </ul>
</div>

@endif
<form method="post"  action="/admin/articles/create">
@csrf
<div class="form-group">
   <label for="title">title :</label>
   <input type="text" name="title" class="form-control">

</div>
<div class="form-group">
   <label for="body">body :</label>
   <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
   
</div>
<button class="btn btn-danger"> send</button>
</form>

@endsection