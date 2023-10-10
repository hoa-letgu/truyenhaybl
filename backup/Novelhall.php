<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Novelhall extends CrawlerCore
{
    public $referer = 'https://google.com/';

    function list($page)
    {
        $html = $this->curl("https://www.novelhall.com/all-$page.html");

        $crawler = (new Crawler($html));

        return array_filter($crawler->filter(".section3 table a")->each(function (Crawler $node){
            return "https://www.novelhall.com". $node->attr('href');
        }));
    }

    function info($url){
        $html = $this->curl($url);
        $crawler = new Crawler($html);

        $data['name'] = $crawler->filter(".book-info h1")->text();

        if(!$data['name']){
            return [];
        }

        $data['cover'] = $crawler->filter(".img-thumbnail")->attr('src');
        $data['description'] = $crawler->filter(".js-close-wrap")->text();
        $data['description'] = rtrim($data['description'],'back');

        $status = explode_by("Status：", "</span>", $html);
        $data['status'] = (trim($status) === 'Active') ? 'on-going' : 'completed';

        $data['taxonomy']['genres'] = $crawler->filter(".book-info .red")->each(function (Crawler $node){
           return trim($node->text());
        });

        $author = explode_by("Author：", "<", $html);
        $data['taxonomy']['authors'] = [
            trim($author)
        ];

        $data['type'] = 'light-novel';

        $data['list_chapter'] = (array_filter($crawler->filter("#morelist ul li.status-publish a")->each(function (Crawler $node){
            preg_match('/(ch|c|chapter|chương|chap)(.[\d.]+)(.*)/is', $node->text(), $output_array);

            $chapName = trim($output_array[2] ?? $node->text());
            if(!$chapName){
               return [];
            }

            $name_extend = trim($output_array[3] ?? null);
            if($name_extend){
                $name_extend = ltrim($name_extend, '-');
                $name_extend = ltrim($name_extend, ':');
            }

            return [
                'name_extend' => $name_extend,
                'name' => "Chapter " . $chapName,
                'url' =>  "https://www.novelhall.com". $node->attr('href')
            ];

        })));

        return $data;
    }

    function content($url){
        $html = $this->curl($url);
        $crawler = new Crawler($html);

        $chapter['type'] = 'text';
        $chapter['content'] = $crawler->filter("#htmlContent")->outerHtml();
        $chapter['content'] = $this->strip_word_html($chapter['content']);

        return $chapter;
    }
}