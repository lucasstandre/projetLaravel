<?php

namespace Tests\Feature;

use App\Services\Livre;
use Tests\TestCase;

class WelcomeControllerTest extends TestCase
{
    /**
     * Test de la page d'accueil avec simulation (Mock) du service Livre.
     */
    public function test_index(): void
    {
        // 1. Création du Mock
        $this->mock(Livre::class, function ($mock) {
            $mock->shouldReceive('getTitle')->andReturn('Titre');
        });

        // 2. Action (requête HTTP)
        $response = $this->get('/welcome');

        // 3. Assertions
        $response->assertSuccessful();
        $response->assertViewHas('titre', 'Titre');
    }
}
