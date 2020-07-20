<?php

namespace App\Http\Controllers;

use App\Articles\ELibrary;
use App\Articles\GoogleScholar;
use App\Articles\ScholarProfileParser;
use App\Util\MyCURL;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function show() {
        $teachers_google   = require base_path() . '/App/Articles/TeacherInfo/GoogleScholar.php';
        $teachers_elibrary = require base_path() . '/App/Articles/TeacherInfo/ELibrary.php';

        $google   = new GoogleScholar();
        $elibrary = new ELibrary();

        $teachers_info = [];
        foreach ($teachers_elibrary as $teacher) {
            $teachers_info[] = $elibrary->getInfo($teacher);
        }
        return view('articles.show-teacher')->with([
            'teachers' => $teachers_info
        ]);
    }
}
