<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;

class TesseractController extends Controller
{
    public function parse(Request $request) {
        $filename = $request->input('filename');
        $path = 'uploads/' . $filename;

        // check if file exist
        if (Storage::disk('public')->exists($path)) {
            $file = Storage::disk('public')->path($path);

            try {
                $tesseractOcr = new TesseractOCR($file);
                $text = $tesseractOcr->run();
            } catch (Exception $e) {
                return back()->with('error', $e->getMessage());
            }

            return back()->with('success', $text);
        }

        return back()->with('error', 'File not found');
    }
}
