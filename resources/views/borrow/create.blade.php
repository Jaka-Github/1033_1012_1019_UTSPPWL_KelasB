@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Borrow a Book</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('borrow.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="book">Select Book</label>
            <select name="book_id" id="book" class="form-control" required>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }} (Stock: {{ $book->stock }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Borrow</button>
    </form>
</div>
@endsection
