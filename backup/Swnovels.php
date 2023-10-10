<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Swnovels extends CrawlerCore
{
    public $referer = 'https://google.com/';

    function list($page = 1)
    {
        $html = $this->curl("https://swnovels.com/new-novel?page=$page");
        $crawler = new Crawler($html);

        return $crawler->filter(".books-list-view-wg .bookhori .info")->each(function (Crawler $node){
            $node = $node->filter("a")->eq(0);
            return "https://swnovels.com". $node->attr("href");
        });
    }

    function info($url){
        $html = $this->curl($url);
        $crawler = new Crawler($html);
        $bookID = explode_by("bookInfo = {id:", ",", $html);
        $bookSlug = explode_by("slug: '", "'", $html);

        $data['name'] = $crawler->filter(".book-title")->text();
        $data['cover'] = $crawler->filter(".bookinfo-wg .img-container .img")->attr("data-src");
        $data['taxonomy']['authors'] = $crawler->filter(".authors .value a")->each(function (Crawler $node){
            return trim($node->text());
        });
        $data['taxonomy']['genres'] = $crawler->filter(".categories .value a")->each(function (Crawler $node){
            return trim($node->text());
        });

        $data['description'] = $crawler->filter("#bookinfo")->text();
        $data['description'] = trim(str_replace("(adsbygoogle=window.adsbygoogle||[]).push({});", '', $data['description']));

        $data['status'] = (trim($crawler->filter(".status .value")->text()) === 'Ongoing') ? 'on-going' : 'completed';

        $getChap = $this->curl("https://a.swnovels.com/v1/books/$bookID/chapters?limit=999999999999");
        if(!$getChap){
            exit("Can't get list chapter");
        }
        $getChap = json_decode($getChap)->data;

        foreach ($getChap as $chap){
            $data['list_chapter'][] = [
                'name' => $chap->title,
                'url' => "https://swnovels.com/$bookSlug/r$chap->id.html"
            ];
        }

        return $data;
    }

    function content($url){
        $html = $this->bypass($url);
        $crawler = new Crawler($html);

        $crawler->filter(".adsbygoogle,.mgline, script, .schedule-text")->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });

        $content = $this->strip_word_html($crawler->filter(".readerbody-wg")->outerHtml());

        return [
            'type' => 'text',
            'content' => str_replace('img{max-width: 100%;}', '', $content)
        ];

    }

    function bypass($url){
        return $this->curl("http://194.233.68.86:3000/?url=$url");
    }

}