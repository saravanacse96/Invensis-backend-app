@extends('layouts.secondary')
<style>
    img{
        height: 10rem;
    }
</style>
@section('content')
<div class="container" >
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>
                <div class="card-body">
                </div>
                <ul>
                @foreach ( $pages as $page)
                    @if($page->type == 'Payment Page')
                        <li style="margin:2em;padding:2em;display:inline-block;">
                            <div class="card-item" style="width: 18rem;height:18rem">
                                <img src="{{asset(Storage::url(('app/public/pages/images/' . $page->image))) }}" class="card-img-top" alt="Page Img">
                                <div class="card-body">
                                    <h5 class="card-title">{{$page->product}}</h5>
                                    <p class="card-text">{{$page->description}}</p>
                                    <p class="card-text">{{$page->price}}</p>
                                    <a href="{{ route('checkout', $page->id) }}" class="btn btn-primary">Checkout</a>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
