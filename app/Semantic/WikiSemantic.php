<?php


namespace App\Semantic;

use App\API\WikipediaApi;
use App\Util\PHPQueryParser;

require_once(base_path() . "/vendor/autoload.php");


class WikiSemantic implements ISemanticParsable
{
    const TERMS_TAG = 'div.mw-parser-output ol li';

    private $parser;
    private $wikiApi;


    public function __construct()
    {
        $this->parser  = new PHPQueryParser();
        $this->wikiApi = new WikipediaApi();
    }


    public function getTermsByWords(string $word): string
    {
        $text = $this->wikiApi->GetWikiPage($word);
        return $this->parser->ParseText($text, self::TERMS_TAG);
    }
}
