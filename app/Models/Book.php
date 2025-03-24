<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',         // Judul buku
        'author',        // Penulis buku
        'publisher',     // Penerbit buku
        'year',          // Tahun terbit
        'stock'       // Jumlah buku yang tersedia
 
    ];


}
