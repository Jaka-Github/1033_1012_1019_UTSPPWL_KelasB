@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Borrow a Book</h2>

    <!-- Menampilkan buku yang bisa dipinjam -->
    <div class="row">
        @foreach ($books as $book)
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">Author: {{ $book->author }}</p>
                    <p class="card-text">Publisher: {{ $book->publisher }}</p>
                    <p class="card-text"><strong>Stock: {{ $book->stock }}</strong></p>

                    @if($book->stock > 0)
                    <button type="button" class="btn btn-primary w-100" 
                        data-bs-toggle="modal" 
                        data-bs-target="#borrowModal"
                        data-book-id="{{ $book->id }}">
                        Borrow
                    </button>
                    @else
                    <button class="btn btn-secondary w-100" disabled>Out of Stock</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Buku yang sedang dipinjam -->
    <h2 class="mt-5">Your Borrowed Books</h2>
    <div class="row">
        @foreach ($borrows as $borrow)
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $borrow->book->title }}</h5>
                    <p class="card-text">Author: {{ $borrow->book->author }}</p>
                    <p class="card-text">Borrow Date: {{ $borrow->borrow_date }}</p>
                    <p class="card-text"><strong>Status: {{ ucfirst($borrow->status) }}</strong></p>

                    @if($borrow->status == 'borrowed')
                    <form action="{{ route('borrow.return', $borrow->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">Return Book</button>
                    </form>
                    @else
                    <button class="btn btn-secondary w-100" disabled>Returned</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="borrowModal" tabindex="-1" aria-labelledby="borrowModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="borrowModalLabel">Borrow a Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('borrow.store') }}" method="POST">
                @csrf
                <input type="hidden" id="modal_book_id" name="book_id">
                <div class="mb-3">
                    <label for="borrow_date" class="form-label">Borrow Date:</label>
                    <input type="date" class="form-control" id="borrow_date" name="borrow_date" placeholder="Pick a date">
                </div>
                <div class="mb-3">
                    <label for="return_date" class="form-label">Return Date:</label>
                    <input type="date" class="form-control" id="return_date" name="return_date" placeholder="Pick a date">
                </div>
                <button type="submit" class="btn btn-success">Confirm Borrow</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk menangani book_id di modal -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    var borrowModal = document.getElementById('borrowModal');
    
    borrowModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Tombol yang memicu modal
        var bookId = button.getAttribute('data-book-id'); // Ambil ID buku
        document.getElementById('modal_book_id').value = bookId; // Set nilai input hidden
    });
});
</script>
@endsection
