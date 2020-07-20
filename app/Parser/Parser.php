<?php


namespace App\Parser;


abstract class ParserBase
{
    protected $text;

    public function __construct(&$text)
    {
        $this->text = $text;
    }

    abstract public function parse();
}
