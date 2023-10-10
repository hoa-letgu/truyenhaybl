<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Boxnovel extends CrawlerCore
{
    public $referer = 'https://boxnovel.com/';

    function list($page)
    {
        $html = $this->curl("https://boxnovel.com/novel/page/$page");

        $crawler = (new Crawler($html));

        return array_filter($crawler->filter(".page-listing-item .page-item-detail .item-thumb a")->each(function (Crawler $node){
            return $node->attr('href');
        }));
    }

    function info($url){
        $html = $this->minifier($this->curl($url));
        $crawler = new Crawler($html);

        $data['name'] = $crawler->filter(".post-title h1")->text();

        if(!$data['name']){
            return [];
        }

        $post_content = $crawler->filter('.post-content_item')->each(function (Crawler $node){
            return $node->outerHtml();
        });

        foreach ($post_content as $item){
            if(strpos($item, 'Alternative') !== false){
                $data['other_name'] = (new Crawler($item))->filter(".summary-content")->text();
            }

            if(strpos($item, 'Status') !== false){
                $data['status'] = (new Crawler($item))->filter(".summary-content")->text();
                $data['status'] = ($data['status'] === 'OnGoing') ?  'on-going' : 'completed';
            }
        }


        $data['cover'] = $crawler->filter(".summary_image img")->attr('src');

        $data['description'] = $this->strip_word_html($crawler->filter(".description-summary .summary__content")->outerHtml());
        $data['description'] = str_replace('BOXNOVEL', getConf('meta')['site_name'], $data['description']);
        $data['description'] = str_replace('Boxnovel.com', getConf('meta')['site_name'], $data['description']);

        $data['taxonomy']['genres'] = $crawler->filter(".genres-content a")->each(function (Crawler $node){
            return trim($node->text());
        });

        $data['taxonomy']['authors'] = $crawler->filter(".author-content a")->each(function (Crawler $node){
            return trim($node->text());
        });

        $data['type'] = 'light-novel';

        $htmlPost = $this->post($url. "ajax/chapters/");

        $data['list_chapter'] = array_reverse(array_filter((new Crawler($htmlPost))->filter(".listing-chapters_wrap li a")->each(function (Crawler $node){
            preg_match('/(chapter|chương|chap)(.[\d.]+)(.*)/is', $node->text(), $output_array);

            $output_array[2] = trim($output_array[2] ?? $node->text());

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

        $crawler->filter("h2.text-center")->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });

        $crawler->filter("h3.dib")->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });

        $chapter['type'] = 'text';
        $chapter['content'] = $crawler->filter(".reading-content .text-left")->outerHtml();
        $chapter['content'] = $this->strip_word_html($chapter['content']);


        return $chapter;
    }
}