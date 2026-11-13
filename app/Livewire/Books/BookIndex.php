<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class BookIndex extends Component
{
   use WithPagination;
   
     // Filter
    public $search = '';
    public $category = '';

    // Form
    public $bookId;
    public $isbn;
    public $judul;
    public $penulis;
    public $penerbit;
    public $tahun_terbit;
    public $stok = 0;
    public $kategori;

    // State modal
    public $isEdit = false;
    public $showForm = false;
    public $deleteId = null;
    public $detailId = null;

    protected function rules()
    {
        return [
            'isbn' => [
                'required', 'string', 'max:20',
                Rule::unique('books', 'isbn')->ignore($this->bookId),
            ],
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'stok'         => 'required|integer|min:0',
            'kategori'     => 'required|string|max:100',
        ];
    }

    protected $messages = [
        'isbn.required'         => 'ISBN wajib diisi.',
        'isbn.unique'           => 'ISBN sudah terdaftar.',
        'judul.required'        => 'Judul wajib diisi.',
        'penulis.required'      => 'Penulis wajib diisi.',
        'penerbit.required'     => 'Penerbit wajib diisi.',
        'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
        'tahun_terbit.digits'   => 'Tahun terbit harus 4 digit.',
        'tahun_terbit.max'      => 'Tahun terbit tidak boleh melebihi tahun ini.',
        'stok.required'         => 'Stok wajib diisi.',
        'stok.min'              => 'Stok tidak boleh negatif.',
        'kategori.required'     => 'Kategori wajib diisi.',
    ];

    // Reset ke halaman 1 saat filter berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    // ---------- DETAIL ----------
    public function showBook($id)
    {
        $this->detailId = $id;
    }

    public function closeDetail()
    {
        $this->detailId = null;
    }

    // ---------- TAMBAH ----------
    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showForm = true;
    }

    // ---------- EDIT ----------
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        $this->bookId       = $book->id;
        $this->isbn         = $book->isbn;
        $this->judul        = $book->judul;
        $this->penulis      = $book->penulis;
        $this->penerbit     = $book->penerbit;
        $this->tahun_terbit = $book->tahun_terbit;
        $this->stok         = $book->stok;
        $this->kategori     = $book->kategori;

        $this->resetValidation();
        $this->isEdit = true;
        $this->showForm = true;
    }

    public function editFromDetail($id)
    {
        $this->detailId = null;
        $this->edit($id);
    }

    // ---------- SIMPAN (tambah / update) ----------
    public function save()
    {
        $this->validate();

        $data = [
            'isbn'         => $this->isbn,
            'judul'        => $this->judul,
            'penulis'      => $this->penulis,
            'penerbit'     => $this->penerbit,
            'tahun_terbit' => $this->tahun_terbit,
            'stok'         => $this->stok,
            'kategori'     => $this->kategori,
        ];

        if ($this->isEdit) {
            Book::findOrFail($this->bookId)->update($data);
            session()->flash('success', 'Data buku berhasil diperbarui.');
        } else {
            Book::create($data);
            session()->flash('success', 'Buku baru berhasil ditambahkan.');
        }

        $this->closeForm();
    }

    // ---------- HAPUS ----------
    public function confirmDelete($id)
    {
        $this->detailId = null;
        $this->deleteId = $id;
    }

    public function delete()
    {
        $book = Book::findOrFail($this->deleteId);

        // Cegah hapus kalau masih dipinjam (aktif setelah tabel loans ada)
        if (class_exists(\App\Models\Loan::class)
            && Schema::hasTable('loans')
            && $book->loans()->where('status', 'dipinjam')->exists()) {
            session()->flash('error', 'Buku tidak bisa dihapus karena masih dipinjam.');
            $this->deleteId = null;
            return;
        }

        $book->delete();
        $this->deleteId = null;
        session()->flash('success', 'Buku berhasil dihapus.');
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
    }

    // ---------- UTIL ----------
    public function closeForm()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset([
            'bookId', 'isbn', 'judul', 'penulis',
            'penerbit', 'tahun_terbit', 'stok', 'kategori',
        ]);
        $this->stok = 0;
        $this->resetValidation();
    }

    public function render()
    {
        $books = Book::search($this->search)
            ->when($this->category, fn ($q) => $q->where('kategori', $this->category))
            ->latest()
            ->paginate(12);

        return view('livewire.books.book-index', [
            'books'      => $books,
            'categories' => Book::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori'),
            'detailBook' => $this->detailId ? Book::find($this->detailId) : null,
        ])->layout('layouts.app'); // sesuaikan dgn layout Orang 1
    }
}
