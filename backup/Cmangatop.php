<?php

namespace Crawler;

class Cmangatop
{
    public $referer = 'https://cmanga.b-cdn.net/';
    public $proxy = false;
    public $type = NULL;
    private $key = "nettruyenhayvn";

    function list($page)
    {
        $url = "https://cmanga.b-cdn.net/api/list_item?page=$page&limit=10&sort=new&type=all&tag&child=off&status=all&num_chapter=0";

        $curl_respone = $this->curl($url);
        $curl_respone = $this->CryptoJSAesDecrypt($this->key, $curl_respone);
        $curl_respone = json_decode($curl_respone);
        $data = [];

        if ($curl_respone) {
            foreach ($curl_respone as $item) {
                if (!empty($item->url)) {
                    $data[] = 'https://cmanga.b-cdn.net/' . $item->url . '-' . $item->id_book . '?_x_tr_sl=en&_x_tr_tl=en&_x_tr_hl=vi&_x_tr_pto=op';
                }
            }

        }

        return $data;
    }

    function info($url)
    {

        $curl_respone = $this->curl($url);

        if ($curl_respone) {

            $id = explode_by('book_id = "', '"', $curl_respone);
            $info_data = $this->curl("https://cmanga.b-cdn.net/api/book_detail?opt1=$id&_x_tr_sl=en&_x_tr_tl=en&_x_tr_hl=vi&_x_tr_pto=op");
            $info_data = $this->CryptoJSAesDecrypt($this->key, $info_data);
            $info_data = json_decode($info_data)[0];

            if (!$info_data) {
                return;
            }
            $data['name'] = mb_convert_case($info_data->name, MB_CASE_TITLE, "UTF-8");
            $data['name'] = trim(str_replace('(Drop)', '', $data['name']));

            $data['other_name'] = $info_data->other_name ?? NULL;


            $data['cover'] = "https://cmanga.b-cdn.net/assets/tmp/book/avatar/$info_data->avatar.jpg";


            $data['description'] = $info_data->detail ?? NULL;


            $data['status'] = slugGenerator($info_data->status) == 'dang-tien-hanh' || slugGenerator($info_data->status) == 'dang-thuc-hien' ? 'on-going' : 'completed';

            $tags = trim($info_data->tags, ',');

            $data['taxonomy']['genres'] = explode(',', $tags);

            foreach ($data['taxonomy']['genres'] as $key => $genres) {
                $genres = $this->change_category($genres);
                $this->set_type($genres);

                $data['taxonomy']['genres'][$key] = $genres;
                if ($this->blacklist_category($genres)) {
                    return;
                }
            }

            $data['type'] = $this->type;


            $chapter_data = $this->curl("https://cmanga.b-cdn.net/api/book_chapter?opt1=$id&_x_tr_sl=en&_x_tr_tl=en&_x_tr_hl=vi&_x_tr_pto=op");
            $chapter_data = $this->CryptoJSAesDecrypt($this->key, $chapter_data);
            $chapter_data = json_decode($chapter_data);

            $data['list_chapter'] = [];
            foreach ($chapter_data as $item) {
                if ($item->chapter_name) {
                    if ((preg_match('#(chapter|chương|chap)(.[\d.]+)#is', $item->chapter_name, $name) ||
                            preg_match('#([C]+)([\d.]+)#is', $item->chapter_name, $name)) && !empty($name[2])) {
                        $item->chapter_name = 'Chapter ' . trim($name[2]);
                    }

                    $data['list_chapter'][] = [
                        "url" => "https://cmanga.b-cdn.net/$info_data->url/chapter-$item->chapter_num/$item->id_chapter",
                        'name' => $item->chapter_name
                    ];
                }
            }

            $data['list_chapter'] = array_reverse(array_filter($data['list_chapter']));

            return $data;
        }
    }

    function content($url)
    {
        $id = basename($url);

        $curl_respone = file_get_contents("https://cmanga.b-cdn.net/api/chapter_content?opt1=$id&_x_tr_sl=en&_x_tr_tl=en&_x_tr_hl=vi&_x_tr_pto=op");

        $curl_respone = $this->CryptoJSAesDecrypt($this->key, $curl_respone);
        // $curl_respone = str_replace('cmanga.b-cdn.net', 'cmanga.b-cdn.net', $curl_respone);
        $curl_respone = json_decode($curl_respone);

        if (!$curl_respone[0]->content) {
            return exit("lỗi");
        }

        $chapter['type'] = 'image';

        $chapter['content'] = json_decode($curl_respone[0]->content);

        return $chapter;
    }

    function set_type($type)
    {
        $list = [
            'Manhwa' => 'manhwa',
            'Manhua' => 'manhua',
            'Manga' => 'manga'
        ];

        foreach ($list as $key => $value) {
            if ($type == $key) {
                return $this->type = $value;
            }
        }

        return 'manga';
    }

    function blacklist_category($key)
    {
        $key = trim($key);

        $black_list = [
            // 'Yaoi',
            // 'LIGHTNOVEL',
            // '18+',
            // 'Soft Yuri',
            // 'Soft Yaoi',
            // 'Smut',
            // 'Yaoi',
            // 'Adult'
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
            'Truyện Siêu Hay' => NULL,
            'Vip' => NULL,
            'Truyện Top' => NULL,
            'Ốcsađọa' => NULL,
            'Beeng.Net' => NULL,
            'Tâm Lý' => 'Psychological',
            'Khoa Học Viễn Tưởng' => 'Sci-fi',
            'Viễn Tưởng' => 'Sci-fi',
            'Giả Tưởng' => 'Sci-fi',
            'Xuyên Không - Hồi Sinh' => 'Xuyên Không',
            'Huyền Huyễn' => 'Mystery',
            'Siêu Nhiên' => 'Supernatural',
            'Siêu Nhiên - Supernatural' => 'Supernatural',
            'Tâm Linh' => 'Supernatural',
            'Hành Động' => 'Action',
            'Hành Động - Action' => 'Action',
            'Trò Chơi' => 'Game',
            'Tưởng Tượng' => 'Fantasy',
            'Phiêu Lưu' => 'Adventure',
            'Hài Hước' => 'Comedy',
            'Hài Hước - Comedy' => 'Comedy',
            'Martial Art' => 'Martial Arts'
        ];

        return (array_key_exists($key, $list) ? $list[$key] : $key);
    }


    function curl($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "referer: https://cmanga.b-cdn.net/",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);

        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }

    function CryptoJSAesDecrypt($passphrase, $jsonString)
    {

        $jsondata = json_decode($jsonString, true);
        try {
            $salt = hex2bin($jsondata["salt"]);
            $iv = hex2bin($jsondata["iv"]);
        } catch (\Exception $e) {
            print_r($e);
            return null;
        }

        $ciphertext = base64_decode($jsondata["ciphertext"]);
        $iterations = 999; //same as js encrypting

        $key = hash_pbkdf2("sha512", $passphrase, $salt, $iterations, 64);

        return openssl_decrypt($ciphertext, 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);

    }

}

