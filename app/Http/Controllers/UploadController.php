<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function upload(Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpeg,png,gif,webp|max:2048'
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        try {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, ['disk' => 'public']);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'File uploaded successfully');
    }

    public function delete(Request $request) {
        $filename = $request->input('filename');
        $path = 'uploads/' . $filename;

        // check if file exist
        if (Storage::disk('public')->exists($path)) {
            // delete file
            Storage::disk('public')->delete($path);

            return back()->with('success', 'File deleted successfully');
        }

        return back()->with('error', 'File not found');
    }
}
