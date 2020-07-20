<?php

namespace App\Articles;


use App\Util\MyCURL;
use App\Util\PHPQueryParser;

class GoogleScholar implements IArticlesParseble
{
    protected $root_url = 'https://scholar.google.com.ua/citations?hl=ru&user=';
    protected $tags = [
        'name' => '#gsc_prf_in',
        'counts' => '#gsc_rsb_st tbody tr .gsc_rsb_std',
        'titles' => '#gsc_rsb_st tbody tr td .gsc_rsb_f'
    ];


    public function getInfo($id)
    {
        $my_curl = new MyCURL();
        $q_parser = new PHPQueryParser();
        //var_dump($q_parser->ParseArray($my_curl->getPageText($this->root_url.$id), $this->tags));
        return $q_parser->ParseArray($my_curl->getPageText($this->root_url.$id), $this->tags);
    }
}
