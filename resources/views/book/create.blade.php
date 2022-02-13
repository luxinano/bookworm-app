@extends('layouts.master')
@section('title', 'New Book')
@section('content')
    <h1>New Book</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route('admin.books.store')}}">
        @csrf
        <div class="mb-3">
            <label for="book_title" class="form-label">Book Title</label>
            <input type="text" class="form-control @error('book_title') is-invalid @enderror" name="book_title" id="book_title">
            @error('book_title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="book_title" class="form-label">Book Summary</label>
            <input type="text" class="form-control @error('book_summary') is-invalid @enderror" name="book_summary" id="book_summary">
            @error('book_summary')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="book_price" class="form-label">Book Price</label>
            <input type="number" class="form-control @error('book_price') is-invalid @enderror" name="book_price" id="book_price">
            @error('book_price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
