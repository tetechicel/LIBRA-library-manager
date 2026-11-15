<?php

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $member_id = '';
    public string $book_id = '';
    public string $loan_date = '';
    public string $due_date = '';
    public string $search = '';

    public function mount(): void
    {
        $this->loan_date = Carbon::today()->format('Y-m-d');
        $this->due_date = Carbon::today()->addDays(7)->format('Y-m-d');
    }

    protected array $rules = [
        'member_id' => 'required|exists:members,id',
        'book_id'   => 'required|exists:books,id',
        'loan_date' => 'required|date',
        'due_date'  => 'required|date|after_or_equal:loan_date',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function storeLoan(): void
    {
        $this->validate();

        $book = Book::findOrFail($this->book_id);

        if ($book->stok <= 0) {
            session()->flash('error', 'Stok buku tidak tersedia untuk dipinjam.');
            return;
        }

        DB::transaction(function () use ($book) {
            Loan::create([
                'member_id' => $this->member_id,
                'book_id'   => $this->book_id,
                'loan_date' => $this->loan_date,
                'due_date'  => $this->due_date,
                'status'    => 'dipinjam',
            ]);

            // Kurangi stok buku
            $book->decrement('stok');
        });

        $this->reset(['member_id', 'book_id']);
        $this->mount();
        session()->flash('message', 'Peminjaman buku berhasil dicatat & stok berkurang.');
    }

    public function returnBook(int $loanId): void
    {
        $loan = Loan::with('book')->findOrFail($loanId);

        if ($loan->status === 'dikembalikan') {
            return;
        }

        DB::transaction(function () use ($loan) {
            $today = Carbon::today();

            $loan->update([
                'return_date' => $today->format('Y-m-d'),
                'status'      => 'dikembalikan',
            ]);

            // Kembalikan stok buku
            $loan->book->increment('stok');
        });

        session()->flash('message', 'Buku berhasil dikembalikan & stok bertambah.');
    }

    public function with(): array
    {
        // Otomatis update status menjadi terlambat jika lewat jatuh tempo
        Loan::where('status', 'dipinjam')
            ->whereDate('due_date', '<', Carbon::today())
            ->update(['status' => 'terlambat']);

        $loans = Loan::with(['member', 'book'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('member', fn($m) => $m->where('name', 'like', '%' . $this->search . '%'))
                      ->orWhereHas('book', fn($b) => $b->where('judul', 'like', '%' . $this->search . '%'));
                });
            })
            ->latest()
            ->paginate(10);

        return [
            'loans'   => $loans,
            'members' => Member::orderBy('name')->get(),
            'books'   => Book::where('stok', '>', 0)->orderBy('judul')->get(),
        ];
    }
};
?>

<div class="p-6 max-w-7xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Manajemen Peminjaman & Pengembalian Buku</h2>

    {{-- Notifikasi --}}
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form Peminjaman Baru --}}
    <div class="bg-white p-6 rounded-lg shadow mb-8">
        <h3 class="text-lg font-semibold mb-4">Catat Peminjaman Baru</h3>
        <form wire:submit="storeLoan" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Anggota</label>
                <select wire:model="member_id" class="w-full border rounded-lg p-2">
                    <option value="">-- Pilih Anggota --</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>
                @error('member_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Buku (Stok Tersedia)</label>
                <select wire:model="book_id" class="w-full border rounded-lg p-2">
                    <option value="">-- Pilih Buku --</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}">{{ $book->judul }} (Stok: {{ $book->stok }})</option>
                    @endforeach
                </select>
                @error('book_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Pinjam</label>
                <input type="date" wire:model="loan_date" class="w-full border rounded-lg p-2">
                @error('loan_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Jatuh Tempo</label>
                <input type="date" wire:model="due_date" class="w-full border rounded-lg p-2">
                @error('due_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-4 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium">
                    Simpan Peminjaman
                </button>
            </div>
        </form>
    </div>

    {{-- Pencarian & Tabel Data Peminjaman --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Daftar Peminjaman</h3>
            <input type="text" wire:model.live="search" placeholder="Cari anggota atau judul buku..." class="border rounded-lg px-3 py-2 w-64">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-sm">
                        <th class="p-3">ID</th>
                        <th class="p-3">Anggota</th>
                        <th class="p-3">Buku</th>
                        <th class="p-3">Tgl Pinjam</th>
                        <th class="p-3">Jatuh Tempo</th>
                        <th class="p-3">Tgl Kembali</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($loans as $loan)
                        <tr>
                            <td class="p-3 font-mono">#{{ $loan->id }}</td>
                            <td class="p-3">{{ $loan->member->name }}</td>
                            <td class="p-3">{{ $loan->book->judul }}</td>
                            <td class="p-3">{{ $loan->loan_date->format('d M Y') }}</td>
                            <td class="p-3">{{ $loan->due_date->format('d M Y') }}</td>
                            <td class="p-3">
                                {{ $loan->return_date ? $loan->return_date->format('d M Y') : '-' }}
                            </td>
                            <td class="p-3">
                                @if($loan->status === 'dipinjam')
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Dipinjam</span>
                                @elseif($loan->status === 'terlambat')
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Terlambat</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Dikembalikan</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                @if($loan->status !== 'dikembalikan')
                                    <button 
                                        wire:click="returnBook({{ $loan->id }})"
                                        wire:confirm="Konfirmasi pengembalian buku ini?"
                                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1 rounded text-xs font-medium">
                                        Kembalikan
                                    </button>
                                @else
                                    <span class="text-gray-400 text-xs">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-4 text-center text-gray-500">Belum ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $loans->links() }}
        </div>
    </div>
</div>