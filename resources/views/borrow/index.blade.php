@extends('layouts.app')


@section('content')
<style>
    body {
        background-color: #f0f0f0; /* Ganti warna sesuai keinginan */
    }
    .section-header {
        position: relative;
        overflow: hidden;
        color: black;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: bolder;
    }
    .section-header-borrow {
        background: white;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .section-header-borrowed {
        background: white;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .section-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.1);
        transform: skewX(-15deg);
    }
</style>
@php
    use Carbon\Carbon;
@endphp
<div class="container">
    
    <h2 class="mb-4 py-4 px-3 text-center rounded section-header section-header-borrow">Borrow a Book</h2>

    <!-- Menampilkan buku yang bisa dipinjam -->
    <div class="row g-4 "> <!-- Spacing lebih baik -->
        @foreach ($books as $book)
        <div class="col-md-3">
            <div class="card shadow-sm p-3"> <!-- Tambahkan bayangan -->
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">By {{ $book->author }}</p>
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

    <!-- Jarak antara bagian peminjaman dan daftar buku yang dipinjam -->
    <br>
    <br>
    <br>
    <br>

    
    <br>
    <br>
    <br>
    <h2 class="mb-4 py-4 px-3 text-center rounded section-header section-header-borrowed">Your Borrowed Books</h2>
    <div class="row g-4">
        @foreach ($borrows as $borrow)
        <div class="col-md-3">
            <div class="card shadow-sm p-3"> <!-- Tambahkan bayangan -->
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $borrow->book->title }}</h5>
                    <p class="card-text">By {{ $borrow->book->author }}</p>
                    <p class="card-text">Borrow Date: {{ \Carbon\Carbon::parse($borrow->borrow_date)->translatedFormat('d F Y') }}</p>
                    <p class="card-text">Return Date: {{ \Carbon\Carbon::parse($borrow->return_date)->translatedFormat('d F Y') }}</p>
                    <p class="card-text"><span class="badge bg-{{ $borrow->status == 'borrowed' ? 'warning' : 'success' }}">
                    {{ ucfirst($borrow->status) }}
                    </span></p>

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
                        <input type="date" class="form-control" id="borrow_date" name="borrow_date">
                    </div>
                    <div class="mb-3">
                        <label for="return_date" class="form-label">Return Date:</label>
                        <input type="date" class="form-control" id="return_date" name="return_date">
                    </div>
                    <button type="submit" class="btn btn-success">Confirm Borrow</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk menangani book_id di modal -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    var borrowModal = document.getElementById('borrowModal');
    borrowModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var bookId = button.getAttribute('data-book-id');
        document.getElementById('modal_book_id').value = bookId;
    });
});
</script>
@endsection
