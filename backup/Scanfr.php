<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Scanfr extends CrawlerCore
{
    public $proxy = true;
    public $referer = 'https://www.scan-fr.org/manga/second-life-on-the-red-carpet';


    function list($page){
        $html = $this->curl("https://www.scan-fr.org/filterList?page=$page&cat=&alpha=&sortBy=name&asc=true&author=&tag=");
        $crawler = new Crawler($html);

        return $crawler->filter(".media-heading a")->each(function (Crawler $node){
            return trim($node->attr("href"));
        });
    }

    function info($url){
        $html = $this->curl($url);
        $crawler = new Crawler($html);

        $data['name'] = '';

            return $data;
    }
}