<?php

namespace Tests\Feature;

use Tests\TestCase;

class NavigationTest extends TestCase
{
    public function test_sidebar_destinations_load_with_the_shared_layout(): void
    {
        $pages = [
            '/dashboard',
            '/books',
            '/profile',
            '/members',
            '/borrowing',
            '/returns',
            '/reports',
            '/settings',
        ];

        foreach ($pages as $page) {
            $this->get($page)
                ->assertOk()
                ->assertSee(asset('assets/libra.css'), false);
        }
    }

    public function test_dashboard_renders_its_livewire_page_content(): void
    {
        $this->get('/dashboard')
            ->assertOk()
            ->assertSee('TODAY AT A GLANCE')
            ->assertSee('The library is quietly bustling.');
    }

    public function test_add_books_page_uses_registered_laravel_routes(): void
    {
        $this->get(route('add-books'))
            ->assertOk()
            ->assertDontSee('.html')
            ->assertSee(route('dashboard'), false)
            ->assertSee(route('book-details'), false);

        $this->get(route('book-details'))->assertOk();
    }

    public function test_library_stylesheet_exists(): void
    {
        $this->assertFileExists(public_path('assets/libra.css'));
    }
}
