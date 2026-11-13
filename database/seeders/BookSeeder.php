<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $books = [
            ['isbn' => '9786020332956', 'judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'penerbit' => 'Bentang Pustaka', 'tahun_terbit' => 2005, 'stok' => 10, 'kategori' => 'Novel'],
            ['isbn' => '9786020324784', 'judul' => 'Bumi Manusia', 'penulis' => 'Pramoedya Ananta Toer', 'penerbit' => 'Lentera Dipantara', 'tahun_terbit' => 1980, 'stok' => 5, 'kategori' => 'Sastra'],
            ['isbn' => '9786023851508', 'judul' => 'Filosofi Teras', 'penulis' => 'Henry Manampiring', 'penerbit' => 'Kompas', 'tahun_terbit' => 2018, 'stok' => 8, 'kategori' => 'Filsafat'],
            ['isbn' => '9786020633176', 'judul' => 'Atomic Habits', 'penulis' => 'James Clear', 'penerbit' => 'Gramedia', 'tahun_terbit' => 2019, 'stok' => 7, 'kategori' => 'Pengembangan Diri'],
            ['isbn' => '9786026486387', 'judul' => 'Pemrograman Web dengan Laravel', 'penulis' => 'Budi Raharjo', 'penerbit' => 'Informatika', 'tahun_terbit' => 2021, 'stok' => 6, 'kategori' => 'Teknologi'],
            ['isbn' => '9781473221680', 'judul' => 'The Midnight Library', 'penulis' => 'Matt Haig', 'penerbit' => 'Canongate', 'tahun_terbit' => 2020, 'stok' => 4, 'kategori' => 'Novel'],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        
    }

    
}
