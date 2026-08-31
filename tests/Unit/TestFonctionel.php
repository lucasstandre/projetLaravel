<?php

namespace Tests\Unit;

use Tests\TestCase;

class TestFonctionel extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_la_page_accueil_fonctionne(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
