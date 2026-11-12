@extends('layouts.app')

@section('content')
<section class="books-page">
  <div class="toolbar">
    <div class="search">
      <input data-livewire-model="search" placeholder="Search title or author..." />
    </div>
    <select data-livewire-model="category">
      <option value="">All categories</option>
      <!-- LIVEWIRE: loop categories -->
    </select>
    <a class="pixel-button" href="{{ route('add-books') }}">+ Add new book</a>
  </div>
  <div class="shelf-room">
    <div class="shelf-header">
      <span>COLLECTION • <b data-bind="books.count">8</b> TITLES</span><i></i><i></i><i></i>
    </div>
    <div class="bookcase-grid">
      <!-- Book cards can be rendered here when the collection is connected. -->
      <button class="shelf-book" data-livewire-click="showBook">
        <div class="book-object" style="--book: #7e3f4d">
          <i></i><strong>The Midnight Library</strong><span>Matt Haig</span>
        </div>
        <div class="book-meta">
          <div><strong>The Midnight Library</strong><span>Matt Haig</span></div>
          <b>4 available</b>
        </div>
      </button>
    </div>
  </div>
  <!-- LIVEWIRE: place the add/edit/detail modal here -->
</section>

@endsection