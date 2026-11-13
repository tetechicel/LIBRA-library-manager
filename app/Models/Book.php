<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
     use HasFactory;

    protected $fillable = [
        'isbn', 'judul', 'penulis', 'penerbit',
        'tahun_terbit', 'stok', 'kategori',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function scopeSearch($query, $keyword)
    {
        if (!$keyword) {
            return $query;
        }

        return $query->where(function ($q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
              ->orWhere('isbn', 'like', "%{$keyword}%")
              ->orWhere('penulis', 'like', "%{$keyword}%")
              ->orWhere('penerbit', 'like', "%{$keyword}%")
              ->orWhere('kategori', 'like', "%{$keyword}%");
        });
    }
}

