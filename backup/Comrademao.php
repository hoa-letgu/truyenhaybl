<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Comrademao extends CrawlerCore
{
    public $referer = 'https://comrademao.com/';


    function list($page)
    {
        $html = $this->curl("https://comrademao.com/novel/page/$page/");

        $crawler = (new Crawler($html));

        return array_unique(array_filter($crawler->filter(".bs .bsx a")->each(function (Crawler $node){
//            $node = $node->filter('a')->eq(1);

            return $node->attr('href');
        })));
    }

    function info($url){
        $html = $this->minifier($this->curl($url));
        $crawler = new Crawler($html);

        $data['name'] = $crawler->filter(".infox .entry-title")->text();

        if(!$data['name']){
            return [];
        }

        $post_content = $crawler->filter('.wd-full')->each(function (Crawler $node){
            return $node->outerHtml();
        });

        foreach ($post_content as $item){

            if(strpos($item, 'Genres:') !== false){
                $data['taxonomy']['genres'] = (new Crawler($item))->filter("a")->each(function (Crawler $node){
                    return trim($node->text());
                });
            }

            if(strpos($item, 'Status') !== false){
                $data['status'] = (new Crawler($item))->filter("a")->eq(0)->text();
                $data['status'] = trim($data['status']) === 'On-going' ? 'on-going' : 'completed';
            }

            if(strpos($item, 'Description') !== false){
                $data['description'] = (new Crawler($item))->filter("span")->eq(0)->text();
            }
        }

        $data['cover'] = $crawler->filter(".thumb img")->attr('src');

        $data['type'] = 'light-novel';

        $data['list_chapter'] = array_reverse(array_filter($crawler->filter(".bxcl .clstyle li .eph-num a")->each(function (Crawler $node){

            preg_match('/(chapter|chương|chap)(.[\d.]+)(.*)/is', $node->filter('.chapternum')->text(), $output_array);

            if(!$output_array[2]){
                return [];
            }

            $name_extend = trim($output_array[3] ?? null);
            if($name_extend){
                $name_extend = ltrim($name_extend, '-');
                $name_extend = ltrim($name_extend, ':');
            }

            return [
                'name_extend' => $name_extend,
                'name' => "Chapter " . trim($output_array[2]),
                'url' =>  $node->attr('href')
            ];
        })));

        return $data;
    }

    function content($url){
        $html = $this->curl($url);
        $crawler = new Crawler($html);

        $crawler->filter("#chaptercontent h3, #chaptercontent header, #bookmark")->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });

        $chapter['type'] = 'text';
        $chapter['content'] = $crawler->filter("#chaptercontent")->outerHtml();
        $chapter['content'] = $this->strip_word_html($chapter['content']);


        return $chapter;
    }
}