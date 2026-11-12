<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main class="login-page">
  <section class="login-illustration" aria-label="A cozy pixel art library at night">
    <div class="login-night-window">
      <span class="login-moon"></span><i class="login-star st1"></i><i class="login-star st2"></i>
    </div>
    <div class="login-hanging-lamp"><i></i></div>
    <div class="login-shelves shelf-left">
      <i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
    </div>
    <div class="login-shelves shelf-right">
      <i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
    </div>
    <div class="login-rug"></div>
    <div class="login-desk">
      <div class="login-desk-books"><i></i><i></i></div>
    </div>
    <div class="login-welcome">
      <p>THE LIBRARY IS RESTING</p>
      <h2>Every story is safe inside.</h2>
      <span>Sign in and begin another day as its keeper.</span>
    </div>
  </section>
  <section class="login-panel">
    <div class="login-card">
      <div class="login-brand">
        <div class="brand-mark"><span></span><span></span><span></span></div>
        <div><strong>LIBRA</strong><small>Library management system</small></div>
      </div>
      <div class="login-heading">
        <p class="eyebrow">KEEPER'S ENTRANCE</p>
        <h1>Welcome back.</h1>
        <p>Enter your credentials to open Pustaka Senja for the day.</p>
      </div>
      <form class="login-form" data-livewire-submit="login">
        <label class="field"
          ><span>Email address</span>
          <div class="login-input"><input type="email" data-livewire-model="email" required /></div
        ></label>
        <label class="field"
          ><span>Password</span>
          <div class="login-input">
            <input type="password" data-livewire-model="password" required /></div
        ></label>
        <!-- LIVEWIRE: render validation errors here -->
        <button class="pixel-button login-submit" type="submit">
          Enter the library <span>→</span>
        </button>
      </form>
    </div>
  </section>
</main>
</body>
</html>