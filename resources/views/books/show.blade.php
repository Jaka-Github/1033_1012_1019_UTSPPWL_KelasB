@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><strong>Book Information</strong></span>
                    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end"><strong>Title:</strong></label>
                        <div class="col-md-6">
                            {{ $book->title ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end"><strong>Author:</strong></label>
                        <div class="col-md-6">
                            {{ $book->author ?? 'Unknown' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end"><strong>Publisher:</strong></label>
                        <div class="col-md-6">
                            {{ $book->publisher ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end"><strong>Year:</strong></label>
                        <div class="col-md-6">
                            {{ $book->year ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end"><strong>Stock:</strong></label>
                        <div class="col-md-6">
                            {{ $book->stock ?? '0' }} books
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
