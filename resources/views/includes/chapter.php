<?php
$metaConf = getConf('meta');

if (isset($chapter->id)) {
    $meta_description = $metaConf['chapter_description'];

    $replaces = [
        '%manga_name%' => $manga->name,
        '%manga_description%' => $manga->description,
        '%other_name%' => $manga->other_name,
        '%chapter_name%' => $chapter->name,
        '%site_name%' => $metaConf['site_name'],
    ];

    if (isset($manga->description) && $manga->description) {
        $replaces['%manga_description%'] = $manga->description;
        $metaConf['chapter_description'] = $meta_description[0];
    } else {
        $metaConf['chapter_description'] = $meta_description[1] ?? '';
    }

    foreach ($replaces as $key => $value) {
        if ($value) {
            $metaConf['chapter_title'] =
                str_replace($key, $value, $metaConf['chapter_title']);
            $metaConf['chapter_description'] =
                str_replace($key, $value, $metaConf['chapter_description']);
        }
    }

    $chapter_url = url('chapter', ['m_slug' => $manga->slug, 'm_id' => $manga->id, 'c_id' => $chapter->id]);
} else {
    include __DIR__ . '/manga.php';

    $metaConf['chapter_title'] = $metaConf['manga_title'];
    $metaConf['chapter_description'] = $metaConf['manga_description'];
}

$manga_url = url('manga', ['m_slug' => $manga->slug, 'm_id' => $manga->id]);
