@extends('layouts.app')

@section('content')
  <!-- content wrapper in center -->
  <div class="w-1/2 mx-auto py-8">
    <!-- add flash message -->
    @if(session('success'))
      <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
        <p class="font-bold">Success</p>
        <p>{{ session('success') }}</p>
      </div>
    @endif

    <!-- add flash message error -->
    @if(session('error'))
      <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
        <p class="font-bold">Error</p>
        <p>{{ session('error') }}</p>
      </div>
    @endif

    <!-- list uploaded content -->
    <p class="mt-3 mb-3">List Uploaded</p>

    @foreach($files as $file)
      <div class="flex items-center mb-3 bg-gray-100 p-2 gap-3">
        <div class="flex-1">
          <p class="mb-0">{{ $file }}</p>
          <div class="max-w-40">
            <img src="{{ '/storage/uploads/'.$file }}" class="w-full" alt="">
          </div>
        </div>
        <div class="flex items-center gap-3">
          <form action="{{ route('tesseract.parse') }}" method="post">
            @csrf
            <input type="text" name="filename" value="{{ $file }}" hidden>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white text-sm font-bold py-1 px-3 rounded">Parse Text</button>
          </form>
          <form action="{{ route('upload.delete') }}" method="post">
            @csrf
            <input type="text" name="filename" value="{{ $file }}" hidden>
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-1 px-3 rounded">Delete</button>
          </form>
        </div>
      </div>
    @endforeach

    <!-- upload btn -->
    <div class="flex items-center">
      <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" class="w-1/2" id="file" name="file">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upload</button>
      </form>
    </div>
  </div>
@endsection