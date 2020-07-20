<?php

namespace App\API;


use phpQuery;

require_once(base_path() . '/vendor/autoload.php');



class WikipediaApi
{

    function GetWikiPage($query) {
        $endPoint = 'https://en.wiktionary.org/w/api.php?action';
        $params = [
            'action' => 'parse',
            'page' => $query,
            'format' => 'json'
        ];

        $url = $endPoint . '?' . http_build_query( $params );

        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close( $ch );

        $result = json_decode( $output, true );

        return $result['parse']['text']['*'];
    }


    public function WikiClient($title)
    {
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'content' => $reqdata = http_build_query(array(
                    'action' => 'query',
                    'list' => 'search',
                    'srsearch' => $title,
                    'format' => 'json'
                )),
                'header' => implode("\r\n", array(
                    "Content-Length: " . strlen($reqdata),
                    "User-Agent: MyCuteBot/0.1",
                    "Connection: Close",
                    ""
                ))
            ))
        );

        if (false === $response = file_get_contents("https://en.wiktionary.org/w/api.php", false, $context)) {
            return false;
        }
        $json = json_decode($response, JSON_UNESCAPED_UNICODE);
        return $json;
    }


    public function gtranslate($str, $lang_from, $lang_to) {
        $query_data = array(
            'client' => 'x',
            'q' => $str,
            'sl' => $lang_from,
            'tl' => $lang_to
        );
        $filename = 'http://translate.google.ru/translate_a/t';
        $options = array(
            'http' => array(
                'user_agent' => 'Mozilla/5.0 (Windows NT 6.0; rv:26.0) Gecko/20100101 Firefox/26.0',
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($query_data)
            )
        );
        $context = stream_context_create($options);
        $response = file_get_contents($filename, false, $context);
        return json_decode($response);
    }


    public function wiktionary($query): bool {

        $url = 'https://en.wiktionary.org/wiki/'.$query;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, true);

        $html = curl_exec($ch);
        curl_close($ch);

        phpQuery::newDocument($html);

        $synonyms = pq('html body div#content.mw-body div#bodyContent.mw-body-content div#mw-content-text.mw-content-ltr div.mw-parser-output ol li span.ib-content')->find('a')->text();

        phpQuery::unloadDocuments();

        return (stripos($synonyms, 'comput') === false ? false : true OR stripos($synonyms, 'program') === false ? false : true OR stripos($synonyms, 'system') === false ? false : true);
    }
}
