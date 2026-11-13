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
    <!-- ===== MODAL: DETAIL BUKU ===== -->
    @if ($detailBook)
    <div class="fixed inset-0 z-50 grid place-items-center bg-black/60 p-4">
        <div class="max-h-[94vh] w-full max-w-[520px] overflow-auto border-[6px] border-[#7a4f3d] bg-[#faf4ea] text-[#3b2521] shadow-[10px_10px_0_#2a1814]"
            role="dialog" aria-modal="true">
            <div
                class="flex items-center justify-between border-b-[5px] border-[#5b2a3b] bg-[#833f52] px-4 py-3 text-white">
                <h3 class="font-serif text-lg">{{ $detailBook->judul }}</h3>
                <button type="button" wire:click="closeDetail" aria-label="Close"
                    class="text-xl leading-none">✕</button>
            </div>

            <div class="px-[22px] pb-5 pt-6 text-sm">
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div><small
                            class="block text-[10px] font-bold text-[#8a6a60]">ISBN</small><b>{{ $detailBook->isbn }}</b>
                    </div>
                    <div><small
                            class="block text-[10px] font-bold text-[#8a6a60]">Category</small><b>{{ $detailBook->kategori }}</b>
                    </div>
                    <div><small
                            class="block text-[10px] font-bold text-[#8a6a60]">Author</small><b>{{ $detailBook->penulis }}</b>
                    </div>
                    <div><small
                            class="block text-[10px] font-bold text-[#8a6a60]">Publisher</small><b>{{ $detailBook->penerbit }}</b>
                    </div>
                    <div><small class="block text-[10px] font-bold text-[#8a6a60]">Publication
                            Year</small><b>{{ $detailBook->tahun_terbit }}</b></div>
                    <div><small
                            class="block text-[10px] font-bold text-[#8a6a60]">Stock</small><b>{{ $detailBook->stok }}
                            available</b></div>
                </div>

                <div class="mt-4 flex items-center justify-end gap-3 border-t border-dotted border-[#a9774f] pt-5">
                    <button type="button" wire:click="closeDetail"
                        class="h-10 px-2 text-sm font-semibold text-[#612639] inline-flex items-center">Close</button>
                    <button type="button" wire:click="confirmDelete({{ $detailBook->id }})"
                        class="inline-flex h-10 items-center justify-center bg-[#8b2635] px-4 text-sm font-semibold text-white shadow-[4px_4px_0_#2e1020]">Delete</button>
                    <button type="button" wire:click="editFromDetail({{ $detailBook->id }})"
                        class="inline-flex h-10 items-center justify-center bg-[#612639] px-4 text-sm font-semibold text-white shadow-[4px_4px_0_#2e1020]">Edit
                        Book</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== MODAL: ADD / EDIT BOOK ===== -->
    @if ($showForm)
    <div class="fixed inset-0 z-[60] grid place-items-center bg-black/60 p-4">
        <div class="max-h-[94vh] w-full max-w-[588px] overflow-auto border-[6px] border-[#7a4f3d] bg-[#faf4ea] text-[#3b2521] shadow-[10px_10px_0_#2a1814]"
            role="dialog" aria-modal="true">
            <div
                class="flex items-center justify-between border-b-[5px] border-[#5b2a3b] bg-[#833f52] px-4 py-3 text-white">
                <h3 class="font-serif text-lg">{{ $isEdit ? 'Edit Book' : 'Add New Book' }}</h3>
                <button type="button" wire:click="closeForm" aria-label="Close" class="text-xl leading-none">✕</button>
            </div>

            <form wire:submit.prevent="save" class="px-[22px] pb-5 pt-6">
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-3.5">
                        <label class="mb-1.5 block text-[10px] font-bold">Book title</label>
                        <input wire:model="judul"
                            class="h-9 w-full border-2 border-[#a9774f] bg-[#fdf8f0] px-3 text-sm font-medium text-[#3b2521] placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#c8a35b]"
                            type="text">
                        @error('judul') <small class="text-xs text-red-700">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3.5">
                        <label class="mb-1.5 block text-[10px] font-bold">Author</label>
                        <input wire:model="penulis"
                            class="h-9 w-full border-2 border-[#a9774f] bg-[#fdf8f0] px-3 text-sm font-medium text-[#3b2521] placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#c8a35b]"
                            type="text">
                        @error('penulis') <small class="text-xs text-red-700">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-3.5">
                        <label class="mb-1.5 block text-[10px] font-bold">ISBN</label>
                        <input wire:model="isbn"
                            class="h-9 w-full border-2 border-[#a9774f] bg-[#fdf8f0] px-3 text-sm font-medium text-[#3b2521] placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#c8a35b]"
                            type="text">
                        @error('isbn') <small class="text-xs text-red-700">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3.5">
                        <label class="mb-1.5 block text-[10px] font-bold">Category</label>
                        <input wire:model="kategori"
                            class="h-9 w-full border-2 border-[#a9774f] bg-[#fdf8f0] px-3 text-sm font-medium text-[#3b2521] placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#c8a35b]"
                            type="text" placeholder="e.g. Novel, Teknologi">
                        @error('kategori') <small class="text-xs text-red-700">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-3.5">
                        <label class="mb-1.5 block text-[10px] font-bold">Publisher</label>
                        <input wire:model="penerbit"
                            class="h-9 w-full border-2 border-[#a9774f] bg-[#fdf8f0] px-3 text-sm font-medium text-[#3b2521] placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#c8a35b]"
                            type="text" placeholder="Publisher name">
                        @error('penerbit') <small class="text-xs text-red-700">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3.5">
                        <label class="mb-1.5 block text-[10px] font-bold">Publication year</label>
                        <input wire:model="tahun_terbit"
                            class="h-9 w-full border-2 border-[#a9774f] bg-[#fdf8f0] px-3 text-sm font-medium text-[#3b2521] placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#c8a35b]"
                            type="number" placeholder="2025">
                        @error('tahun_terbit') <small class="text-xs text-red-700">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-3.5">
                    <label class="mb-1.5 block text-[10px] font-bold">Stock</label>
                    <input wire:model="stok"
                        class="h-9 w-full border-2 border-[#a9774f] bg-[#fdf8f0] px-3 text-sm font-medium text-[#3b2521] placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#c8a35b]"
                        type="number" min="0">
                    @error('stok') <small class="text-xs text-red-700">{{ $message }}</small> @enderror
                </div>

                <div class="mt-4 flex items-center justify-end gap-3 border-t border-dotted border-[#a9774f] pt-5">
                    <button type="button" wire:click="closeForm"
                        class="h-10 px-2 text-sm font-semibold text-[#612639] inline-flex items-center">Cancel</button>
                    <button type="submit"
                        class="inline-flex h-10 items-center justify-center gap-2 bg-[#612639] px-4 text-sm font-semibold text-white shadow-[4px_4px_0_#2e1020]">
                        {{ $isEdit ? 'Save changes' : 'Add to collection' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- ===== MODAL: KONFIRMASI HAPUS ===== -->
    @if ($deleteId)
    <div class="fixed inset-0 z-[70] grid place-items-center bg-black/60 p-4">
        <div class="w-full max-w-[400px] border-[6px] border-[#7a4f3d] bg-[#faf4ea] text-[#3b2521] shadow-[10px_10px_0_#2a1814]"
            role="dialog" aria-modal="true">
            <div
                class="flex items-center justify-between border-b-[5px] border-[#5b2a3b] bg-[#833f52] px-4 py-3 text-white">
                <h3 class="font-serif text-lg">Confirm Delete</h3>
                <button type="button" wire:click="cancelDelete" aria-label="Close"
                    class="text-xl leading-none">✕</button>
            </div>
            <div class="px-[22px] pb-5 pt-6 text-center">
                <p class="text-sm font-medium">Yakin mau hapus buku ini dari koleksi?</p>
                <div class="mt-5 flex items-center justify-center gap-3 border-t border-dotted border-[#a9774f] pt-4">
                    <button type="button" wire:click="cancelDelete"
                        class="h-10 px-3 text-sm font-semibold text-[#612639]">Cancel</button>
                    <button type="button" wire:click="delete"
                        class="inline-flex h-10 items-center justify-center bg-[#8b2635] px-4 text-sm font-semibold text-white shadow-[4px_4px_0_#2e1020]">Ya,
                        Hapus</button>
                </div>
            </div>
        </div>
    </div>
    @endif
