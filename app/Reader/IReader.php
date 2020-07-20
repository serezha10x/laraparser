<?php


namespace App\Reader;


interface IReader
{
    public function read(string $filename): string;
}
