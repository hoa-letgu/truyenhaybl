<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Hentaivl extends CrawlerCore
{
    public $proxy = true;
    public $referer = 'https://hentaivlz.com/';

    public $BLACK_LIST = [
        'Này Anh Đẹp Trai'
    ];

    function list($page)
    {
        $html = $this->curl("https://hentaivlz.com/the-loai/manhwa?page=$page");
        $crawler = new Crawler($html);

        return array_reverse($crawler->filter(".list_wrap .manga-thumb")->each(function (Crawler $node) {
            return "https://hentaivlz.com" . $node->filter('a')->eq(0)->attr('href');
        }));
    }

    function info($url)
    {
        $html = $this->curl($url);

        if (!$html) {
            return NULL;
        }

        $crawler = new Crawler($html);

        if(!$crawler->filter(".title_content_box .title_content h1")->count()){
            return  NULL;
        }

        $data['name'] = $crawler->filter(".title_content_box .title_content h1")->text();
        if($this->isBlacklist($data["name"])){
            return NULL;
        }

        $data['cover'] = $crawler->filter('.novel-thumb img')->attr('src');

        $data['taxonomy']['genres'] = $crawler->filter('.type_box .cate-itm')->each(function (Crawler $node) {
            return $node->text();
        });

        $authors = remove_html(explode_by('Tác giả:', '</span>', $html));
        if ($authors && slugGenerator($authors) !== 'dang-cap-nhat') {
            $data['taxonomy']['authors'][] = $authors;
        }

        $status = explode_by(' Tình trạng:', '</span>', $html);
        $status = slugGenerator(remove_html($status));
        $data['status'] = $status === 'dang-tien-hanh' ? 'on-going' : 'completed';

        $data["list_chapter"] = array_reverse($crawler->filter(".episode-contents .chapter-list li a")->each(function (Crawler $node) {
            return [
                'name' => $node->text(),
                'url' => "https://hentaivlz.com" . $node->attr('href')
            ];
        }));

        return $data;
    }

    function content($url)
    {
        $html = $this->curl($url);
        $crawler = new Crawler($html);


        return [
            'type' => 'image',
            'content' => $crawler->filter(".chapter-content .page-chapter img")->each(function (Crawler $node) {
                return $node->attr('src') ?? $node->attr("data-original");
            })
        ];
    }
}