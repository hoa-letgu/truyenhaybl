<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Readnovelfull extends CrawlerCore
{
    public $referer = 'https://readnovelfull.com/';

    function list($page)
    {

        $url = "https://readnovelfull.com/latest-release-novel?page=$page";
        $curl_respone = $this->curl($url);

        $crawler = new Crawler($curl_respone);

        return $crawler->filter(".list-novel .novel-title a")->each(function (Crawler $node) {
            return 'https://readnovelfull.com' . trim($node->attr('href'));
        });
    }

    function info($url)
    {

        $html = $this->curl($url);
        $crawler = new Crawler($html);


        if ($html) {
            $name = $crawler->filter('h3.title')->text();
            $data['name'] = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");

            $other_name = explode_by('Alternative names: </h3>', '</li>', $html);
            $other_name = trim(mb_convert_case($other_name, MB_CASE_TITLE, "UTF-8"));
            $data['other_name'] = $other_name ?? NULL;

            $data['cover'] = $crawler->filter(".books .book img")->attr('src');

            $description = $crawler->filter("#tab-description .desc-text")->outerHtml();
            $description = str_replace('</p>', "\n</p>", $description);
            $data['description'] = trim(remove_html($description));

            $status = explode_by('Status:</h3>', '</li>', $html);
            $status = slugGenerator(remove_html($status));
            $data['status'] = $status === 'ongoing' ? 'on-going' : 'completed';

            $genres =  explode_by('Genre:</h3>', '</li>', $html);
            $genres = trim(remove_html($genres));
            $data['taxonomy']['genres'] = explode(',', $genres);;

            foreach ($data['taxonomy']['genres'] as $key => $genres) {
                $genres = $this->change_category($genres);

                $data['taxonomy']['genres'][$key] = $genres;
                if ($this->blacklist_category($genres)) {
                    return [];
                }
            }

            $data['type'] = 'light-novel';

            $novelID = trim(explode_by('data-novel-id="', '"', $html));
            $ajaxChapHTML = file_get_contents("https://readnovelfull.com/ajax/chapter-archive?novelId=$novelID");

            $chapCrawler = new Crawler($ajaxChapHTML);


            $chapList = $chapCrawler->filter("li a")->each(function (Crawler $node) {
                preg_match('/(chapter|chương|chap)(.[\d.]+)(.*)/is', $node->attr('title'), $output_array);

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
                    'url' =>  'https://readnovelfull.com'. $node->attr('href')
                ];
            });

            $data['list_chapter'] = array_filter($chapList);

            return $data;
        }

        return [];
    }

    function content($url)
    {
        $html = $this->curl($url);
        $crawler = new Crawler($html);


        $chapter['type'] = 'text';
        $chapter['content'] = $crawler->filter("#chr-content")->outerHtml();
        $chapter['content'] = $this->strip_word_html($chapter['content']);

        return $chapter;
    }


    function blacklist_category($key)
    {
        $key = trim($key);

        $black_list = [
        ];

        if (in_array($key, $black_list)) {
            return true;
        }

        return false;
    }


    function change_category($key)
    {
        $key = trim(mb_convert_case($key, MB_CASE_TITLE, "UTF-8"));
        $list = [
            '' => ''
        ];

        return (array_key_exists($key, $list) ? $list[$key] : $key);
    }
}

