<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Baozimh extends CrawlerCore
{
    public $proxy = false;
    public $referer = 'https://www.baozimh.com';
    public $base = "https://www.baozimh.com";


    function list($page)
    {
        $html = $this->curl("https://www.baozimh.com/classify?type=hanman&region=all&state=all&filter=%2a&page=$page");

        $crawler = new Crawler($html);

        return $crawler->filter("a.comics-card__poster")->each(function (Crawler $node) {
            return $this->base . trim($node->attr("href"));
        });
    }

    function info($url)
    {
        $html = $this->curl($url);
        $crawler = new Crawler($html);

        $data['name'] = $crawler->filter(".comics-detail__title")->text();
        $data['cover'] = $crawler->filter(".pure-u-1-1.pure-u-sm-1-3.pure-u-md-1-6 amp-img")->attr("src");
        $data['taxonomy']['authors'][] = $crawler->filter('.comics-detail__author')->text();
        $data['taxonomy']['genres'] = array_filter($crawler->filter('.comics-detail .tag-list span')->each(function (Crawler $node) {

            return trim($node->text());
        }));
        print_r(($url) . "\n");

        $data['status'] = 'on-going';
        if (strpos($crawler->filter('.comics-detail .tag-list')->text(), '已完結') !== false) {
            $data['status'] = 'completed';
        }

        $data['description'] = $crawler->filter('.comics-detail__desc')->text();

        $data['list_chapter'] = $crawler->filter("#chapter-items .comics-chapters, #chapters_other_list .comics-chapters")->each(function (Crawler $node) {
            $node = $node->filter('a')->eq(0);

            return [
                'name' => $node->text(),
                'url' => 'https://www.baozimh.com' . $node->attr('href')
            ];
        });

        return $data;
    }

    function content($url)
    {
        $html = $this->curl($url);
        $crawler = new Crawler($html);

        return [
            'type' => 'image',
            'content' => $crawler->filter('.comic-chapter .comic-contain img')->each(function (Crawler $node) {
                return $node->attr('src');
            })
        ];
    }
}