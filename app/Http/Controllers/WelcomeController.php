<?php

namespace App\Http\Controllers;

use App\Services\Livre;
use Illuminate\Contracts\View\View;

class WelcomeController extends Controller
{
    /**
     * @return array<int, string>
     */
    public static function middleware(): array
    {
        return [
            'guest',
        ];
    }

    public function index(Livre $livre): View
    {
        $titre = $livre->getTitle();

        return view('welcome', compact('titre'));
    }
}

