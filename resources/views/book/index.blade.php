@extends('layouts.master')
@section('title', 'Book List')
@section('content')
    <h1>Book List</h1>
    <a class="btn btn-primary" href="{{ route('admin.books.create') }}" role="button">Add Book</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
            <tr>
                <th scope="row">{{ $book->id }}</th>
                <td>{{ $book->book_title }}</td>
                <td>{{ $book->book_price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
