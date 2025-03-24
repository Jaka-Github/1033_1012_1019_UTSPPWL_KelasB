@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Edit Book
                    </div>
                    <div class="float-end">
                        <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.update', $book->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-3 row">
                            <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $book->title) }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Author --}}
                        <div class="mb-3 row">
                            <label for="author" class="col-md-4 col-form-label text-md-end text-start">Author</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('author') is-invalid @enderror"
                                    id="author" name="author" value="{{ old('author', $book->author) }}">
                                @error('author')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Publisher --}}
                        <div class="mb-3 row">
                            <label for="publisher" class="col-md-4 col-form-label text-md-end text-start">Publisher</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('publisher') is-invalid @enderror"
                                    id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}">
                                @error('publisher')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Year --}}
                        <div class="mb-3 row">
                            <label for="year" class="col-md-4 col-form-label text-md-end text-start">Year</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control @error('year') is-invalid @enderror"
                                    id="year" name="year" value="{{ old('year', $book->year) }}">
                                @error('year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Stock --}}
                        <div class="mb-3 row">
                            <label for="stock" class="col-md-4 col-form-label text-md-end text-start">Stock</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                    id="stock" name="stock" value="{{ old('stock', $book->stock) }}">
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
