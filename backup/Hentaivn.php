<?php

namespace Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Hentaivn extends CrawlerCore
{
    public $referer = "https://hentaivn.moe/danh-sach.html?page=1";
    public $baseurl = "https://hentaivn.moe";
    public $proxy = true;

    function replace($str)
    {
        return str_replace('hentaivn-moe.translate.goog', 'hevnn.b-cdn.net', $str);
    }

    function bypass($url)
    {
        return $this->curl("https://hevnn.b-cdn.net/3cbab51d-6f44-4569-b131-140fd3802204/ajax?_x_tr_sl=en&_x_tr_tl=vi&_x_tr_hl=vi&_x_tr_pto=wapp&u=$url");
    }

    function list($page)
    {

        $html = $this->curl("https://hevnn.b-cdn.net/danh-sach.html?page=$page&_x_tr_sl=en&_x_tr_tl=vi&_x_tr_hl=vi&_x_tr_pto=op,wapp");
        $crawler = new Crawler($html);

        return array_filter($crawler->filter(".block-item .item")->each(function (Crawler $node) {
            $node = $node->filter("a")->eq(0);
            if ($node->count() <= 0) {
                return null;
            }
            return $this->replace($node->attr('href'));
        }));
    }

    function info($url)
    {

        try {
            if (strpos($url, 'hevnn.b-cdn.net') === false) {
                $url = str_replace("hentaivn.moe", 'hevnn.b-cdn.net', $url) . "?_x_tr_sl=en&_x_tr_tl=vi&_x_tr_hl=vi&_x_tr_pto=op,wapp";
            }

            $html = $this->curl($url);
            $crawler = new Crawler($html);

            $data['name'] = $crawler->filter(".page-info h1")->text();
            $data['cover'] = $crawler->filter(".page-ava img")->attr('src');
            $page_info = $crawler->filter(".page-info p")->each(function (Crawler $node) {
                return $node->html();
            });

            $has_noidung = false;

            foreach ($page_info as $info) {
                $info_crawler = new Crawler($info);
                if ($info_crawler->count() <= 0) {
                    continue;
                }
                if (strpos($info, 'Tên Khác') !== false) {
                    $other_name = $info_crawler->filter('a')->each(function (Crawler $node) {
                        return trim($node->text());
                    });

                    if ($other_name) {
                        $data['other_name'] = implode('; ', $other_name);
                    }
                }

                if (strpos($info, 'Thể Loại:') !== false) {
                    $data['taxonomy']['genres'] = $info_crawler->filter('a')->each(function (Crawler $node) {
                        return trim($node->text());
                    });
                }

                if (strpos($info, 'Tác giả:') !== false) {
                    $data['taxonomy']['authors'] = $info_crawler->filter('a')->each(function (Crawler $node) {
                        return trim($node->text());
                    });
                }

                if (strpos($info, 'Tình Trạng:') !== false) {
                    $status = $info_crawler->filter('a')->eq(0)->text();
                    $data['status'] = $status === 'Đang tiến hành' ? 'on-going' : 'completed';
                }

                if ($has_noidung === true) {


                    $data['description'] = trim($info_crawler->text());

                    $has_noidung = false;
                }

                if (strpos($info, 'Nội dung:') !== false) {
                    $has_noidung = true;
                }

            }

            $ajaxchap = $this->bypass($this->baseurl . "/list-showchapter.php" . explode_by("list-showchapter.php", '"', $html));

            $data['list_chapter'] = array_reverse((new Crawler($ajaxchap))->filter(".listing tr a")->each(function (Crawler $node) {
                return [
                    'url' => $this->baseurl . $node->attr('href'),
                    'name' => $node->text()
                ];
            }));

            return $data;
        } catch (\Exception $e) {
            return [];
        }
    }

    function content($url)
    {
        $html = $this->bypass($url);
        $crawler = new Crawler($html);

        return [
            'type' => 'image',
            'content' => $crawler->filter("#image img")->each(function (Crawler $node) {
                return $node->attr('src');
            })

        ];
    }


}