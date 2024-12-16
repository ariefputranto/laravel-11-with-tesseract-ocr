<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index() {
        $files = Storage::disk('public')->files('uploads');
        $listUploaded = array_map(function($file) {
            return basename($file);
        }, $files);

        return view('home', [
            'files' => $listUploaded
        ]);
    }
}
