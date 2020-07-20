<?php

namespace App\Http\Controllers;

use App\Parser\ParserFrequency;
use App\Parser\ParserRegex;
use App\Reader\Reader;
use App\Reader\ReaderCreator;
use App\Semantic\WikiSemantic;
use App\Parser\ParserTextAnalysis;
use App\Parser\ParserWordsCase;
use App\Parser\SemanticParser;
use Illuminate\Http\Request;


class ParserController extends Controller
{
    public function parse() {
        return view('parser.parse');
    }

    public function submit() {
        $file_path = base_path() . '/docs/' . $_FILES['upload_file']['name'];
        $path = base_path() . "/docs/";
        $path .= basename($_FILES['upload_file']['name']);
        move_uploaded_file($_FILES['upload_file']['tmp_name'], $path);

        $file_ext = pathinfo($file_path)['extension'];
        $reader_creator = new ReaderCreator;
        $reader = $reader_creator->factory($file_ext);
        $text = $reader->read($file_path);

        $parsers['parse_regex']      = new ParserRegex       ($text);
        $parsers['parse_words_case'] = new ParserWordsCase   ($text);
        $parsers['dict_parse']       = new ParserFrequency   ($text);
        $parsers['php_analysis']     = new ParserTextAnalysis($text);
        $parsers['semantic_wordnet'] = new SemanticParser    ($text, 'IT', new WikiSemantic());
        // Для WordNet
        //$parsers['semantic_wordnet'] = new SemanticParser($text, 'IT', new WordNetSemantic());

        $parser_answer = [];
        foreach ($parsers as $key => $value) {
            $parsed_data = $value->parse();
            if (is_array($parsed_data)) {
                foreach ($parsed_data as $key_data => $value_data) {
                    $parser_answer[$key_data] = $value_data;
                }
            } else {
                $parser_answer[$key] = $value->parse();
            }
        }

        return view('parser.parse')->with([
            'parse_data' => $parser_answer,
            'text' => $text
        ]);
    }
}
