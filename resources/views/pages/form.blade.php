@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($page) ? 'Edit Page' : 'Create Page' }}</h1>
    <form action="{{ isset($page) ? route('pages.update', $page->id) : route('pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($page))
        @method('PUT')
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-group">
            <label for="type">Type<span class="mandatory" style="color:red;">*</span></label>
            <select id="type" name="type" class="form-control" required>
                <option value="Normal Page" {{ (isset($page) && $page->type == 'Normal Page') ? 'selected' : '' }}>Normal Page</option>
                <option value="Payment Page" {{ (isset($page) && $page->type == 'Payment Page') ? 'selected' : '' }}>Payment Page</option>
            </select>
        </div>
        <div id="normal-fields" style="{{ (isset($page) && $page->type == 'Payment Page') ? 'display:none;' : '' }}">
            <div class="form-group">
                <label for="title">Title<span class="mandatory" style="color:red;">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="{{ isset($page) ? $page->title : '' }}" >
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description<span class="mandatory" style="color:red;">*</span></label>
            <textarea class="form-control" id="description" name="description" required>{{ isset($page) ? $page->description : '' }}</textarea>
        </div>
        @if (isset($page) && $page->image)
            <div class="form-group" >
                <label for="image">Image<span class="mandatory" style="color:red;">*</span></label>
                <img src="{{asset(Storage::url(('app/public/pages/images/' . $page->image))) }}" alt="Page Image" class="img-thumbnail" style="width:10%">
                <input type="file" class="form-control" id="image" name="image">
                <small class="form-text text-muted">Leave the empty if you don't want to change the image.</small>
            </div>
        @else
            <div class="form-group">
                <label for="image">Image<span class="mandatory" style="color:red;">*</span></label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
        @endif


        <div id="payment-fields" style="{{ (isset($page) && $page->type == 'Payment Page') ? '' : 'display:none;' }}">
            <div class="form-group">
                <label for="product">Product<span class="mandatory" style="color:red;">*</span></label>
                <input type="text" class="form-control" id="product" name="product" value="{{ isset($page) ? $page->product : '' }}">
            </div>
            <div class="form-group">
                <label for="price">Price<span class="mandatory" style="color:red;">*</span></label>
                <input type="text" class="form-control" id="price" name="price" value="{{ isset($page) ? $page->price : '' }}">
            </div>
            <div class="form-group">
                <label for="currency">Currency<span class="mandatory" style="color:red;">*</span></label>
                <input type="text" class="form-control" id="currency" name="currency" value="{{ isset($page) ? $page->currency : '' }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($page) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    document.getElementById('type').addEventListener('change', function() {
        if (this.value == 'Payment Page') {
            document.getElementById('normal-fields').style.display = 'none';
            document.getElementById('payment-fields').style.display = 'block';
        } else {
            document.getElementById('normal-fields').style.display = 'block';
            document.getElementById('payment-fields').style.display = 'none';
        }
    });
</script>
@endsection