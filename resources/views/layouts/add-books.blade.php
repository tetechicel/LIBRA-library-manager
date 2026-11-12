<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add New Book – Libra</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Lora:wght@400;500;600&display=swap" rel="stylesheet">
  <!-- Tailwind (Play CDN). In Laravel, move this config into tailwind.config.js and remove the CDN script -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { theme: { extend: {
      colors: { plum:'#4b1f35', plumd:'#3a1628', wine:'#7d3b4f', wined:'#612639', cream:'#f6f0e7', paper:'#faf4ea', tan:'#a9774f', gold:'#c8a35b', ink:'#3b2521', mute:'#8a6a60', wood:'#6d4430' },
      fontFamily: { serif:['Lora','Georgia','serif'], sans:['"DM Sans"','system-ui','sans-serif'] },
      boxShadow: { hard:'4px 4px 0 #2e1020', tan:'3px 3px 0 #a9774f', modal:'10px 10px 0 #2a1814' }
    } } }
  </script>
</head>
<body class="bg-cream font-sans text-ink">
<div class="grid min-h-screen grid-cols-[212px_1fr] max-md:grid-cols-1">
  <!-- ===== SIDEBAR (→ components/sidebar.blade.php) ===== -->
  <aside class="flex flex-col gap-2 border-r-4 border-[#5a2a40] bg-gradient-to-b from-plum to-plumd px-4 pb-4 pt-6 text-[#ead9cc]">
    <div class="mb-3 flex items-center gap-3 border-b-2 border-[#6a3450] px-2 pb-[18px]">
      <span class="grid h-10 w-10 place-items-center bg-gold text-3xl font-bold text-plum">+</span>
      <div><b class="block font-serif text-2xl font-semibold tracking-[.14em]">LIBRA</b><small class="text-[10px] tracking-[.2em] text-[#b99a90]">LIBRARY KEEPER</small></div>
    </div>
    <nav class="flex flex-col gap-1.5">
      <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-[#e8d5c8] hover:bg-white/5">
        <span class="grid h-[30px] w-[30px] place-items-center border border-[#7a4a5e]">
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 11l9-8 9 8v10H3z"/>
            <path d="M9 21v-6h6v6"/>
          </svg>
        </span>Dashboard
      </a>
      <a href="{{ route('books') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm bg-cream text-ink shadow-[3px_3px_0_#2a0f1c]">
        <span class="grid h-[30px] w-[30px] place-items-center border border-ink">
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 5h7a2 2 0 0 1 2 2v13a2 2 0 0 0-2-2H3z"/>
            <path d="M21 5h-7a2 2 0 0 0-2 2v13a2 2 0 0 1 2-2h7z"/>
          </svg>
        </span>Books
      </a>
      <a href="{{ route('profile') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-[#e8d5c8] hover:bg-white/5"><span class="grid h-[30px] w-[30px] place-items-center border border-[#7a4a5e]"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg></span>Profile</a>
      <a href="{{ route('members') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-[#e8d5c8] hover:bg-white/5"><span class="grid h-[30px] w-[30px] place-items-center border border-[#7a4a5e]"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3.5"/><path d="M2 21a7 7 0 0 1 14 0"/><circle cx="17" cy="9" r="2.5"/><path d="M17 14a5 5 0 0 1 5 5"/></svg></span>Members</a>
      <a href="{{ route('borrowing') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-[#e8d5c8] hover:bg-white/5"><span class="grid h-[30px] w-[30px] place-items-center border border-[#7a4a5e]"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 4v16"/><path d="M9 12h12"/><path d="M16 7l5 5-5 5"/></svg></span>Borrowing</a>
      <a href="{{ route('returns') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-[#e8d5c8] hover:bg-white/5"><span class="grid h-[30px] w-[30px] place-items-center border border-[#7a4a5e]"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 14L4 9l5-5"/><path d="M4 9h11a5 5 0 0 1 0 10h-3"/></svg></span>Returns</a>
      <a href="{{ route('reports') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-[#e8d5c8] hover:bg-white/5"><span class="grid h-[30px] w-[30px] place-items-center border border-[#7a4a5e]"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20V4"/><path d="M4 20h16"/><path d="M9 16v-5M14 16V8M19 16v-3"/></svg></span>Reports</a>
      <a href="{{ route('settings') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-[#e8d5c8] hover:bg-white/5"><span class="grid h-[30px] w-[30px] place-items-center border border-[#7a4a5e]"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><circle cx="12" cy="12" r="8"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg></span>Settings</a>
    </nav>
    <div class="mt-auto space-y-2">
      <div class="flex items-center gap-2.5 border border-[#6a3450] p-2.5 text-xs"><span class="relative inline-block shrink-0 bg-[#d9bf9f] h-8 w-8"><span class="absolute inset-x-0 top-0 h-1/2 bg-[#2e1e1e]"></span><span class="absolute inset-x-[12%] bottom-0 top-[55%]" style="background:#1f1a1a"></span></span><div><small class="block text-[9px] tracking-[.14em] text-[#a98a80]">SIGNED IN AS</small>Clara Wijaya</div></div>
      <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 border border-[#6a3450] p-2.5 text-xs"><svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4H4v16h5"/><path d="M12 12h9M17 7l5 5-5 5"/></svg> Logout</a>
      <div class="flex items-center gap-2.5 border border-[#6a3450] p-2.5 text-xs"><span class="h-8 w-8 bg-gold/80"></span><div><small class="block text-[9px] tracking-[.14em] text-[#a98a80]">LIBRARY HOURS</small>08:00 — 18:00</div></div>
    </div>
  </aside>
  <div class="flex min-w-0 flex-col">
    <!-- ===== TOP BAR ===== -->
    <header class="flex items-start justify-between bg-cream px-8 pb-3 pt-5">
      <div><small class="text-[10px] tracking-[.2em] text-wine">PUSTAKA SENJA · ADMIN DESK</small><h1 class="mt-1.5 font-serif text-3xl">Books</h1></div>
      <div class="flex items-center gap-1.5 border-2 border-tan bg-paper px-2.5 py-1.5 shadow-tan"><small class="text-[9px] text-mute">MON</small><b class="font-serif text-2xl">16</b><small class="text-[9px] text-mute">JUNE</small></div>
    </header>
    <main class="flex flex-1 flex-col bg-cream">
      <!-- ===== TOOLBAR ===== -->
      <div class="flex gap-3 bg-cream px-8 pb-5 pt-2">
        <div class="relative max-w-[420px] flex-1"><input class="h-9 w-full border-2 border-tan bg-[#fdf8f0] px-3 text-sm font-medium text-ink placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold !h-[42px] pl-9" type="search" placeholder="Search title or author…"><span class="absolute left-3 top-3 text-mute"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg></span></div>
        <select class="h-9 w-full border-2 border-tan bg-[#fdf8f0] px-3 text-sm font-medium text-ink placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold !h-[42px] !w-[150px]"><option>All</option><option>Fiction</option><option>Science</option><option>Classic</option></select>
        <a href="{{ route('add-books') }}" class="inline-flex h-10 items-center justify-center gap-2 bg-wined px-4 text-sm font-semibold text-white shadow-hard !h-[42px] no-underline">+ Add new book</a>
      </div>
      <!-- ===== BOOK GRID ===== -->
      <section class="mx-8 min-h-[300px] flex-1 border-[3px] border-[#4a2c24] bg-[#5a3a30] p-2">
        <small class="block px-2.5 py-2 text-[10px] tracking-[.2em] text-[#b79a8c]">COLLECTION · 8 TITLES</small>
        <div class="grid grid-cols-4 gap-0.5 max-lg:grid-cols-2">
        <a href="{{ route('book-details') }}" class="bg-[#7a5342] text-left text-[#f1e3d3] no-underline">
          <div class="grid h-44 place-items-center"><div class="flex h-[120px] w-[82px] flex-col justify-center border-4 border-[#2b1a16] px-1.5 text-center font-serif text-[11px] leading-tight shadow-[6px_6px_0_rgba(0,0,0,.35)]" style="background:#7d3b4f">The Midnight Library<small class="mt-1.5 text-[8px] opacity-60">Matt Haig</small></div></div>
          <div class="flex items-center justify-between bg-[#664033] p-3"><div><b class="block font-serif text-[13px] font-medium">The Midnight Library</b><small class="text-[9px] opacity-70">Matt Haig</small></div><span class="bg-[#e9d7bf] px-1.5 py-1 text-[8px] font-bold text-ink">4 available</span></div>
        </a>
        <a href="{{ route('book-details') }}" class="bg-[#7a5342] text-left text-[#f1e3d3] no-underline">
          <div class="grid h-44 place-items-center"><div class="flex h-[120px] w-[82px] flex-col justify-center border-4 border-[#2b1a16] px-1.5 text-center font-serif text-[11px] leading-tight shadow-[6px_6px_0_rgba(0,0,0,.35)]" style="background:#44627e">A Brief History of Time<small class="mt-1.5 text-[8px] opacity-60">Stephen Hawking</small></div></div>
          <div class="flex items-center justify-between bg-[#664033] p-3"><div><b class="block font-serif text-[13px] font-medium">A Brief History of Time</b><small class="text-[9px] opacity-70">Stephen Hawking</small></div><span class="bg-[#e9d7bf] px-1.5 py-1 text-[8px] font-bold text-ink">2 available</span></div>
        </a>
        <a href="{{ route('book-details') }}" class="bg-[#7a5342] text-left text-[#f1e3d3] no-underline">
          <div class="grid h-44 place-items-center"><div class="flex h-[120px] w-[82px] flex-col justify-center border-4 border-[#2b1a16] px-1.5 text-center font-serif text-[11px] leading-tight shadow-[6px_6px_0_rgba(0,0,0,.35)]" style="background:#9a5a4a">Little Women<small class="mt-1.5 text-[8px] opacity-60">Louisa May Alcott</small></div></div>
          <div class="flex items-center justify-between bg-[#664033] p-3"><div><b class="block font-serif text-[13px] font-medium">Little Women</b><small class="text-[9px] opacity-70">Louisa May Alcott</small></div><span class="bg-[#e9d7bf] px-1.5 py-1 text-[8px] font-bold text-ink">3 available</span></div>
        </a>
        <a href="{{ route('book-details') }}" class="bg-[#7a5342] text-left text-[#f1e3d3] no-underline">
          <div class="grid h-44 place-items-center"><div class="flex h-[120px] w-[82px] flex-col justify-center border-4 border-[#2b1a16] px-1.5 text-center font-serif text-[11px] leading-tight shadow-[6px_6px_0_rgba(0,0,0,.35)]" style="background:#6b6a4a">The Secret Garden<small class="mt-1.5 text-[8px] opacity-60">Frances Hodgson</small></div></div>
          <div class="flex items-center justify-between bg-[#664033] p-3"><div><b class="block font-serif text-[13px] font-medium">The Secret Garden</b><small class="text-[9px] opacity-70">Frances Hodgson</small></div><span class="bg-[#e9d7bf] px-1.5 py-1 text-[8px] font-bold text-ink">1 available</span></div>
        </a>
        <a href="{{ route('book-details') }}" class="bg-[#7a5342] text-left text-[#f1e3d3] no-underline">
          <div class="grid h-44 place-items-center"><div class="flex h-[120px] w-[82px] flex-col justify-center border-4 border-[#2b1a16] px-1.5 text-center font-serif text-[11px] leading-tight shadow-[6px_6px_0_rgba(0,0,0,.35)]" style="background:#b0823f">Atomic Habits<small class="mt-1.5 text-[8px] opacity-60">James Clear</small></div></div>
          <div class="flex items-center justify-between bg-[#664033] p-3"><div><b class="block font-serif text-[13px] font-medium">Atomic Habits</b><small class="text-[9px] opacity-70">James Clear</small></div><span class="bg-[#e9d7bf] px-1.5 py-1 text-[8px] font-bold text-ink">5 available</span></div>
        </a>
        <a href="{{ route('book-details') }}" class="bg-[#7a5342] text-left text-[#f1e3d3] no-underline">
          <div class="grid h-44 place-items-center"><div class="flex h-[120px] w-[82px] flex-col justify-center border-4 border-[#2b1a16] px-1.5 text-center font-serif text-[11px] leading-tight shadow-[6px_6px_0_rgba(0,0,0,.35)]" style="background:#4f6a58">Dune<small class="mt-1.5 text-[8px] opacity-60">Frank Herbert</small></div></div>
          <div class="flex items-center justify-between bg-[#664033] p-3"><div><b class="block font-serif text-[13px] font-medium">Dune</b><small class="text-[9px] opacity-70">Frank Herbert</small></div><span class="bg-[#e9d7bf] px-1.5 py-1 text-[8px] font-bold text-ink">2 available</span></div>
        </a>
        <a href="{{ route('book-details') }}" class="bg-[#7a5342] text-left text-[#f1e3d3] no-underline">
          <div class="grid h-44 place-items-center"><div class="flex h-[120px] w-[82px] flex-col justify-center border-4 border-[#2b1a16] px-1.5 text-center font-serif text-[11px] leading-tight shadow-[6px_6px_0_rgba(0,0,0,.35)]" style="background:#5a4a6a">1984<small class="mt-1.5 text-[8px] opacity-60">George Orwell</small></div></div>
          <div class="flex items-center justify-between bg-[#664033] p-3"><div><b class="block font-serif text-[13px] font-medium">1984</b><small class="text-[9px] opacity-70">George Orwell</small></div><span class="bg-[#e9d7bf] px-1.5 py-1 text-[8px] font-bold text-ink">3 available</span></div>
        </a>
        <a href="{{ route('book-details') }}" class="bg-[#7a5342] text-left text-[#f1e3d3] no-underline">
          <div class="grid h-44 place-items-center"><div class="flex h-[120px] w-[82px] flex-col justify-center border-4 border-[#2b1a16] px-1.5 text-center font-serif text-[11px] leading-tight shadow-[6px_6px_0_rgba(0,0,0,.35)]" style="background:#a2543f">Sapiens<small class="mt-1.5 text-[8px] opacity-60">Yuval Noah Harari</small></div></div>
          <div class="flex items-center justify-between bg-[#664033] p-3"><div><b class="block font-serif text-[13px] font-medium">Sapiens</b><small class="text-[9px] opacity-70">Yuval Noah Harari</small></div><span class="bg-[#e9d7bf] px-1.5 py-1 text-[8px] font-bold text-ink">3 available</span></div>
        </a>
        </div>
      </section>
    </main>
  </div>
</div>
<!-- ===== MODAL: Add New Book (→ components/modal.blade.php) ===== -->
<div class="fixed inset-0 z-50 grid place-items-center bg-black/60 p-4">
  <div class="max-h-[94vh] w-full max-w-[588px] overflow-auto border-[6px] border-[#7a4f3d] bg-paper shadow-modal" role="dialog" aria-modal="true" aria-label="Add New Book">
    <div class="flex items-center justify-between border-b-[5px] border-[#5b2a3b] bg-[#833f52] px-4 py-3 text-white"><h3 class="font-serif text-lg">Add New Book</h3><a href="{{ route('books') }}" aria-label="Close" class="text-xl">✕</a></div>
    <form action="{{ route('books') }}" class="px-[22px] pb-5 pt-6">
      <div class="grid grid-cols-2 gap-3"><div class="mb-3.5"><label class="mb-1.5 block text-[10px] font-bold">Book title</label><input class="h-9 w-full border-2 border-tan bg-[#fdf8f0] px-3 text-sm font-medium text-ink placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold" type="text" placeholder="" value=""></div><div class="mb-3.5"><label class="mb-1.5 block text-[10px] font-bold">Author</label><input class="h-9 w-full border-2 border-tan bg-[#fdf8f0] px-3 text-sm font-medium text-ink placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold" type="text" placeholder="" value=""></div></div>
      <div class="grid grid-cols-2 gap-3"><div class="mb-3.5"><label class="mb-1.5 block text-[10px] font-bold">ISBN</label><input class="h-9 w-full border-2 border-tan bg-[#fdf8f0] px-3 text-sm font-medium text-ink placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold" type="text" placeholder="" value=""></div><div class="mb-3.5"><label class="mb-1.5 block text-[10px] font-bold">Category</label><select class="h-9 w-full border-2 border-tan bg-[#fdf8f0] px-3 text-sm font-medium text-ink placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold"><option selected>Fiction</option><option>Science</option><option>Classic</option></select></div></div>
      <div class="grid grid-cols-2 gap-3"><div class="mb-3.5"><label class="mb-1.5 block text-[10px] font-bold">Publisher</label><input class="h-9 w-full border-2 border-tan bg-[#fdf8f0] px-3 text-sm font-medium text-ink placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold" type="text" placeholder="Publisher name" value=""></div><div class="mb-3.5"><label class="mb-1.5 block text-[10px] font-bold">Publication year</label><input class="h-9 w-full border-2 border-tan bg-[#fdf8f0] px-3 text-sm font-medium text-ink placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold" type="number" placeholder="2025" value=""></div></div>
      <div class="mb-3.5"><label class="mb-1.5 block text-[10px] font-bold">Stock</label><input class="h-9 w-full border-2 border-tan bg-[#fdf8f0] px-3 text-sm font-medium text-ink placeholder:text-[#b8a396] focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold" type="number" placeholder="" value="1"></div>
      <div class="mt-4 flex items-center justify-end gap-3 border-t border-dotted border-tan pt-5">
        <a href="{{ route('books') }}" class="h-10 px-2 text-sm font-semibold text-wined inline-flex items-center">Cancel</a>
        <a href="{{ route('books') }}" class="inline-flex h-10 items-center justify-center gap-2 bg-wined px-4 text-sm font-semibold text-white shadow-hard">Add to collection</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
