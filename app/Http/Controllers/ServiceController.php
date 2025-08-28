<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display the service selection page.
     */
    public function index(): View
    {
        $services = [
            [
                'name' => 'Internet Connections',
                'description' => 'Pengurusan data sambungan internet dan kelajuan',
                'icon' => 'fas fa-wifi',
                'route' => 'internet-connections.index',
                'color' => 'primary'
            ],
            [
                'name' => 'Cyber Attack',
                'description' => 'Pengurusan data serangan siber dan keselamatan',
                'icon' => 'fas fa-shield-alt',
                'route' => 'cyber-attacks.index',
                'color' => 'danger'
            ],
            [
                'name' => 'Digitalization',
                'description' => 'Pengurusan projek digitalisasi dan pembangunan',
                'icon' => 'fas fa-digital-tachograph',
                'route' => 'digitalizations.index',
                'color' => 'success'
            ]
        ];

        return view('service.index', compact('services'));
    }
}