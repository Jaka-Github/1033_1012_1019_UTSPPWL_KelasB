<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book; // Ganti model Product ke Book
use App\Http\Requests\UpdateBookRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    /**
     * Instantiate a new BukuController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-book|edit-book|delete-book', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-book', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-book', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-book', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('books.index', [
            'books' => Book::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        Book::create($request->all());
        return redirect()->route('books.index')
            ->withSuccess('Buku baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View
    {
        return view('books.show', [
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
    {
        return view('books.edit', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->all());
        return redirect()->back()
            ->withSuccess('Data buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('books.index')
            ->withSuccess('Buku berhasil dihapus.');
    }
}
