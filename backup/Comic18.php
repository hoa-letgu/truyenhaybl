<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Comic18 extends CrawlerCore
{
    public $proxy = true;
    public $scramble = true;
    public $referer = "https://18comic.vip/";

    function list($page = 1)
    {
        $html = $this->curl("https://18comic-vip.translate.goog/albums/hanman?page=$page&_x_tr_sl=en&_x_tr_tl=vi&_x_tr_hl=vi&_x_tr_pto=op,wapp");
        $crawler = new Crawler($html);

        return $crawler->filter(".container .row .p-b-15.p-l-5.p-r-5 .thumb-overlay-albums")->each(function (Crawler $node) {
            $node = $node->filter("a")->eq(0);

            return $node->attr("href");
        });
    }

    function info($url)
    {
        $html = $this->curl($url);
        $crawler = new Crawler($html);

        $data['name'] = $crawler->filter(".panel-heading h1")->text();
        $data['cover'] = $crawler->filter(".thumb-overlay img")->attr("src");

        $data['taxonomy']['genres'] = $crawler->filter(".tag-block span[itemprop=genre] a")->each(function (Crawler $node) {
            return trim($node->text());
        });

        $data['taxonomy']['authors'] = $crawler->filter(".col-xs-12 .tag-block span[itemprop=author] a")->each(function (Crawler $node) {
            return trim($node->text());
        });

        $data['description'] = remove_html(explode_by("敘述：", '</div>', $html));
        $data['status'] = 'on-going';

        $crawler->filter('.episode ul a span')->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });

        $data['list_chapter'] = $crawler->filter("#episode-block .episode ul a")->each(function (Crawler $node) {

            return [
                'name' => $node->text(),
                'url' => $node->attr('href')
            ];
        });

        return $data;
    }

    function content($url)
    {
        $html = $this->curl($url);
        $crawler = new Crawler($html);

        $data = [
            'chapter_id' => str_replace('?_x_tr_sl=en&_x_tr_tl=vi&_x_tr_hl=vi&_x_tr_pto=op,wapp', '', basename($url)),
            'scramble' => true,
            'type' => 'image',
            'content' => $crawler->filter(".scramble-page img")->each(function (Crawler $node) {
                return explode('?v=',trim($node->attr("data-original")))[0];
            })];

        return $data;
    }


}