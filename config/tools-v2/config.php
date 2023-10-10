<?php

$site = getConf('site');


// Config for redis server
$redis = new \Predis\Client([
    'host' => 'localhost',
    'port' => 6379,
    'password' => '',
    'database' => 0,
]);

// Local storage driver

/** =======================================================
$storage_driver = new \Services\StorageDriver\Local(
    [
        'root_path' => ROOT_PATH . '/public/uploads',
        'base_url' => $site['site_url'] . '/uploads',
    ]
);
=======================================================*/

// Tistory storage driver

/** ======================================================= */

$tistok_config = file_get_contents(__DIR__ . '/tistory_config.txt');

$tistok_config = explode("\n", $tistok_config);
// randomize
$tistok_config = $tistok_config[array_rand($tistok_config)];

$tistok_config = explode("||", $tistok_config);

$blog_name = trim($tistok_config[0]);
$cookie = trim($tistok_config[1]);

$tistok_driver = new \Services\StorageDriver\Tistory(
    [
        'cookie' => $cookie,
        'blog_name' => $blog_name,
    ]
);

/** ======================================================= */
// Google storage driver
// include_once __DIR__ . '/google-drive-config.php';

// $storage_driver = new \Services\StorageDriver\Blogger();
/** ======================================================= */

return [
    'storage_driver' => $tistok_driver,
    'cover_driver' => $tistok_driver,
    'redis' => $redis,
    'max_thread' => 1,
    'max_download_thread' => 5,
    'max_upload_thread' => 5,
    'max_retry' => 3,
];
