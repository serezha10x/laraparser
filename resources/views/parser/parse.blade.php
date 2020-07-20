@extends('layouts.app')

@section('title', 'Парсинг')

@section('content')
    <div>
        <p>
            Выберите файл формата:
            @php
                $path = base_path() . '/App/Reader/config/formats.php'
            @endphp
            @if(file_exists($path))
                @php
                    $formats = require base_path() . '/App/Reader/config/formats.php';
                    $size = count($formats) - 1;
                @endphp
                @for($i = 0; $i < $size; $i++)
                    {{ $formats[$i] . ', ' }}
                @endfor
                {{ $formats[$size] . '.' }}
            @endif

        </p>
    </div>
    <form class="was-validated" id="form-file-ajax" enctype="multipart/form-data" action="{{ route('parser-submit') }}" method="POST">
        @csrf
        <div class="custom-file">
            <input name="upload_file" type="file" id="file" class="custom-file-input" required name="get-text">
            <label class="custom-file-label any-input" for="validatedCustomFile">Выберите файл...</label>
            <button class="btn btn-primary any-btn" type="submit" value="Upload" name="submit">Разобрать текст</button>
        </div>
    </form>
    <div>
        <br/>
        @isset($parse_data)
            @foreach($parse_data as $parse_method)
                <p>{{ $parse_method }}</p>
            @endforeach
        @endisset
    </div>
    <div>
        @isset($text)
            {{ $text }}
        @endisset
    </div>
@endsection
