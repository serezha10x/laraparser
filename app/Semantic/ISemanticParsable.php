<?php


namespace App\Semantic;

interface ISemanticParsable
{
    public function getTermsByWords(string $word) : string;
}
