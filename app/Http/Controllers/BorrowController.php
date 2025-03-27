<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function index()
    {
        $books = Book::all(); // Ambil semua data buku
        $borrows = Borrow::where('user_id', auth()->user()->id)->with('book')->get();

        return view('borrow.index', compact('books', 'borrows'));
    }


    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('borrow.create', compact('books'));
    }

    public function returnBook($id)
    {
        $borrow = Borrow::findOrFail($id);

        if ($borrow->status !== 'borrowed') {
            return redirect()->back()->with('error', 'Book is already returned!');
        }

        // Update status
        $borrow->update([
        'status' => 'returned',
        'return_date' => now(),
        ]);

        // Kembalikan stok buku
        $book = Book::findOrFail($borrow->book_id);
        $book->increment('stock');

        return redirect()->route('borrow.index')->with('success', 'Book returned successfully!');
    }


    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'return_date' => 'nullable|date|after_or_equal:today',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Book is out of stock!');
        }

        Borrow::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'return_date' => $request->return_date,
            'status' => 'borrowed',
        ]);

        $book->decrement('stock');

        return redirect()->route('borrow.index')->with('success', 'Book borrowed successfully!');
    }
}
