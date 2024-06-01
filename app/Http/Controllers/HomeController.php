<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $data = [
            'message' => 'Hello from the controller!',
            'items' => ['Item 1', 'Item 2', 'Item 3']
        ];

        return Inertia::render('Welcome', [
            'data' => $data
        ]);
    }
}
