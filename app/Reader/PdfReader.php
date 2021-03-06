<?php


namespace App\Reader;
require_once(base_path() . "/vendor/autoload.php");

class PdfReader implements IReader
{

    public function read(string $filename): string
    {
        $parser = new \Smalot\PdfParser\Parser();
        try {
            $pdf = $parser->parseFile($filename);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return '';
        }
        //var_dump($pdf->getText());
        return $pdf->getText();
    }
}
