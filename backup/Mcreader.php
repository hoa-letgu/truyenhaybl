<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Mcreader extends CrawlerCore
{
    public $referer = 'https://www.mcreader.net';

    function list($page)
    {

        $url = "https://www.mcreader.net/jumbo/manga/?results=$page";

        $html = $this->curl($url);

        if (!$html) {
            return [];
        }

        $crawler = new Crawler($html);

        return array_filter($crawler->filter('.novel-list.grid.col.col2.chapters li a')->each(function (Crawler $node) {
            return "https://www.mcreader.net" . trim($node->attr('href'));
        }));
    }

    function info($url)
    {

        $html = $this->curl($url);
        $crawler = new Crawler($html);


        $manga = $crawler->filter('#novel .novel-info');
        if ($manga->count() <= 0) {
            return die('Có lỗi khi lấy dữ liệu!');
        }

        $data['name'] = $crawler->filter('.fixed-img .cover img')->attr('alt');

        $data['other_name'] = trim($manga->filter('.alternative-title')->text());
        $data['other_name'] = $data['other_name'] !== "Updating" ? $data['other_name'] : "";

        $data['cover'] = $crawler->filter('.fixed-img .cover img')->attr('data-src');

        $data['description'] = $crawler->filter('.summary .content');
        $data['description'] = $data['description']->count() > 0 ? $data['description']->text() : "";

        $data['status'] = $manga->filter('.header-stats .ongoing')->count();
        $data['status'] = $data['status'] > 'Ongoing' ? 'on-going' : 'completed';

        $data['taxonomy']['authors'] = $manga->filter('.author span[itemprop="author"]')->each(function (Crawler $node) {
            $authors = trim($node->text());

            if ($authors === 'Zinmanga') {
                return [];
            }

            return $authors;
        });

        $data['taxonomy']['genres'] = $manga->filter('.categories li a')->each(function (Crawler $node) {
            return trim($node->text());
        });

        $allchapters = $this->curl($url . '/all-chapters/');
        $crawler = new Crawler($allchapters);


        $data['list_chapter'] = $crawler->filter('.chapter-list li')->each(function (Crawler $node) {
            if ($node->count() <= 0) {
                return [];
            }

            $node = $node->filter("a")->eq(0);

            $chapter['name'] = trim($node->filter(".chapter-title")->text());

            if (strpos($chapter['name'], 'eng-li') === false) {
                return [];
            }

            $chapter['name'] = "Chapter " . str_replace("-eng-li", "", $chapter['name']);

            $chapter['url'] = "https://www.mcreader.net" . trim($node->attr('href'));
            return $chapter;
        });

        $data['list_chapter'] = array_reverse(array_filter($data['list_chapter']));

        return $data;


    }

    function content($url)
    {
        $curl_respone = $this->curl($url);


        if ($curl_respone) {
            $crawler = new Crawler($curl_respone);
            $chapter['type'] = 'image';

            $chapter['content'] = $crawler->filter('.content-wrap img')->each(function (Crawler $node) {
                //return $this->AddProxy(trim($node->attr('data-src')));

                if ($node->attr('src') == 'https://toonix.xyz/cdn_mangaraw/shinai/999.jpg') {
                    return null;
                }

                return trim($node->attr('src'));
            });
            $chapter['content'] = array_filter($chapter['content']);
            return $chapter;
        }

        return exit("lỗi");
    }

}