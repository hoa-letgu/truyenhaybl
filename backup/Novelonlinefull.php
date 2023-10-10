<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Novelonlinefull extends CrawlerCore
{
    public $referer = 'https://novelonlinefull.com/';


    function list($page)
    {
        $html = $this->curl("https://novelonlinefull.com/novel_list?type=latest&category=all&state=all&page=$page");

        $crawler = (new Crawler($html));

        return array_filter($crawler->filter(".danh_sach .update_item .update_item_right h3 a")->each(function (Crawler $node){
            return $node->attr('href');
        }));
    }

    function info($url){
        $html = $this->minifier($this->curl($url));
        $crawler = new Crawler($html);

        $data['name'] = $crawler->filter(".truyen_info_right h1")->text();

        if(!$data['name']){
            return [];
        }

        $post_content = $crawler->filter('.truyen_info_right li')->each(function (Crawler $node){
            return $node->outerHtml();
        });

        foreach ($post_content as $item){
            if(strpos($item, 'Author(s)') !== false){
                $data['taxonomy']['authors'] = (new Crawler($item))->filter("li a")->each(function (Crawler $node){
                    return trim($node->text());
                });
            }

            if(strpos($item, 'Alternative') !== false){
                $data['other_name'] = trim(explode_by("Alternative :", '</span>', $item));
            }

            if(strpos($item, 'GENRES:') !== false){
                $data['taxonomy']['genres'] = (new Crawler($item))->filter("li a")->each(function (Crawler $node){
                    return trim($node->text());
                });
            }

            if(strpos($item, 'STATUS') !== false){
                $data['status'] = (new Crawler($item))->filter("a")->eq(0)->text();
                $data['status'] = trim($data['status']) === 'Ongoing' ? 'on-going' : 'completed';
            }
        }

        $data['cover'] = $crawler->filter(".truyen_info_left .info_image img")->attr('src');

        $crawler->filter("#noidungm h2")->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });

        $data['description'] = $crawler->filter("#noidungm")->text();

        $data['type'] = 'light-novel';

        $data['list_chapter'] = array_reverse(array_filter($crawler->filter(".chapter-list .row span a")->each(function (Crawler $node){
            preg_match('/(ch|c|chapter|chương|chap)(.[\d.]+)(.*)/is', $node->text(), $output_array);

            $chapName = trim($output_array[2] ?? $node->text());
            if(!$chapName){
                return [];
            }

            $name_extend = trim($output_array[3] ? "Chapter " . $output_array[3] : null);

            if($name_extend){
                $name_extend = ltrim($name_extend, '-');
                $name_extend = ltrim($name_extend, ':');
            }

            return [
                'name_extend' => $name_extend,
                'name' => $chapName,
                'url' =>  $node->attr('href')
            ];
        })));

        return $data;
    }

    function content($url){
        $html = $this->curl($url);
        $crawler = new Crawler($html);

        $crawler->filter("#vung_doc h3")->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });

        $chapter['type'] = 'text';
        $chapter['content'] = $crawler->filter("#vung_doc")->outerHtml();

        return $chapter;
    }
}