<section class="books-page">

  @if (session()->has('success')) <p style="color:green">{{ session('success') }}</p> @endif
  @if (session()->has('error')) <p style="color:red">{{ session('error') }}</p> @endif

  <div class="toolbar">
    <div class="search">
      <input wire:model.live.debounce.300ms="search" placeholder="Search title or author..." />
    </div>
    <select wire:model.live="category">
      <option value="">All categories</option>
      @foreach ($categories as $cat)
        <option value="{{ $cat }}">{{ $cat }}</option>
      @endforeach
    </select>
    <button class="pixel-button" wire:click="create">+ Add new book</button>
  </div>

  <div class="shelf-room">
    <div class="shelf-header">
      <span>COLLECTION • <b>{{ $books->total() }}</b> TITLES</span><i></i><i></i><i></i>
    </div>

    @php
      $colors = ['#7e3f4d', '#3f5f7e', '#4d7e3f', '#7e6b3f', '#5b3f7e', '#3f7e74'];
    @endphp

    <div class="bookcase-grid">
      @forelse ($books as $book)
        <button class="shelf-book" wire:key="book-{{ $book->id }}" wire:click="showBook({{ $book->id }})">
          <div class="book-object" style="--book: {{ $colors[$book->id % count($colors)] }}">
            <i></i><strong>{{ $book->judul }}</strong><span>{{ $book->penulis }}</span>
          </div>
          <div class="book-meta">
            <div><strong>{{ $book->judul }}</strong><span>{{ $book->penulis }}</span></div>
            <b>{{ $book->stok > 0 ? $book->stok . ' available' : 'Out of stock' }}</b>
          </div>
        </button>
      @empty
        <p>Data buku tidak ditemukan.</p>
      @endforelse
    </div>

    {{ $books->links() }}
  </div>

  <!-- detail -->
  @if ($detailBook)
    <div style="position:fixed; inset:0; background:rgba(0,0,0,.5); display:flex; align-items:center; justify-content:center; z-index:50">
      <div style="background:#fff; color:#000; padding:20px; min-width:320px; max-width:90%">
        <h3>{{ $detailBook->judul }}</h3>
        <p>ISBN: {{ $detailBook->isbn }}</p>
        <p>Penulis: {{ $detailBook->penulis }}</p>
        <p>Penerbit: {{ $detailBook->penerbit }}</p>
        <p>Tahun: {{ $detailBook->tahun_terbit }}</p>
        <p>Kategori: {{ $detailBook->kategori }}</p>
        <p>Stok: {{ $detailBook->stok }}</p>
        <button wire:click="editFromDetail({{ $detailBook->id }})">Edit</button>
        <button wire:click="confirmDelete({{ $detailBook->id }})">Hapus</button>
        <button wire:click="closeDetail">Tutup</button>
      </div>
    </div>
  @endif

<!-- form tambah \ edit  -->
  @if ($showForm)
    <div style="position:fixed; inset:0; background:rgba(0,0,0,.5); display:flex; align-items:center; justify-content:center; z-index:60">
      <form wire:submit.prevent="save" style="background:#fff; color:#000; padding:20px; min-width:320px">
        <h4>{{ $isEdit ? 'Edit Buku' : 'Tambah Buku' }}</h4>

        <input type="text" wire:model="isbn" placeholder="ISBN">
        @error('isbn') <small style="color:red">{{ $message }}</small> @enderror <br>

        <input type="text" wire:model="judul" placeholder="Judul">
        @error('judul') <small style="color:red">{{ $message }}</small> @enderror <br>

        <input type="text" wire:model="penulis" placeholder="Penulis">
        @error('penulis') <small style="color:red">{{ $message }}</small> @enderror <br>

        <input type="text" wire:model="penerbit" placeholder="Penerbit">
        @error('penerbit') <small style="color:red">{{ $message }}</small> @enderror <br>

        <input type="number" wire:model="tahun_terbit" placeholder="Tahun Terbit">
        @error('tahun_terbit') <small style="color:red">{{ $message }}</small> @enderror <br>

        <input type="number" wire:model="stok" min="0" placeholder="Stok">
        @error('stok') <small style="color:red">{{ $message }}</small> @enderror <br>

        <input type="text" wire:model="kategori" placeholder="Kategori">
        @error('kategori') <small style="color:red">{{ $message }}</small> @enderror <br>

        <button type="submit">Simpan</button>
        <button type="button" wire:click="closeForm">Batal</button>
      </form>
    </div>
  @endif

  <!-- konfirmasi hapus -->
  @if ($deleteId)
    <div style="position:fixed; inset:0; background:rgba(0,0,0,.5); display:flex; align-items:center; justify-content:center; z-index:70">
      <div style="background:#fff; color:#000; padding:20px">
        <p>Yakin mau hapus buku ini?</p>
        <button wire:click="delete">Ya, Hapus</button>
        <button wire:click="cancelDelete">Batal</button>
      </div>
    </div>
  @endif

</section>