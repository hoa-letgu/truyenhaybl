<?php

$metaConf = getConf('meta');
$meta_description = $metaConf['manga_description'];
if(strpos($meta_description, ':|:') !== false){
    $meta_description = explode(':|:', $meta_description);
}

$replaces = [
    '%manga_name%' => $manga->name,
    '%manga_description%' => $manga->description ?? '',
    '%other_name%' => $manga->other_name,
    '%site_name%' => $metaConf['site_name'],
];

if(isset($manga->description) && $manga->description){
    $replaces['%manga_description%'] = $manga->description;
    $metaConf['manga_description'] = $meta_description[0];
} else {
    $metaConf['manga_description'] = $meta_description[1] ?? '';
}

foreach ($replaces as $key => $value) {
    if ($value) {
        $metaConf['manga_title'] =
            str_replace($key, $value, $metaConf['manga_title']);

        $metaConf['manga_description'] =
            str_replace($key, $value, $metaConf['manga_description']);
    }

}

$manga_url = manga_url($manga);

if(isset($manga->cover) && $manga->cover){
    if(strpos($manga->cover, 'http') === false){
        $manga->cover = url($manga->cover);
    }
}