@extends('layouts.payment')

@section('content')
<div class="container">
    <div style="margin-left:35em">
        <img src="{{asset(Storage::url(('app/public/pages/images/' . $page->image))) }}" alt="Page Image" class="img-thumbnail" style="width:30%;border:none;">
        <h1>{{$page->title}}</h1>
        <p>{{$page->description}}</p>
    </div>
</div>
@endsection
