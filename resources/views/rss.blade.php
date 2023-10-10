
<?= '<?xml version="1.0" encoding="UTF-8" ?><?xml-stylesheet type="text/xsl" href="'.url('rss.xsl').'"?>'; ?>

<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
    <channel>
        @php
        $metaConf = getConf('meta');
        @endphp

        <title>{{ $metaConf['home_title'] }}</title>
        <link>{{ url('home') }}</link>
        <description>{{ $metaConf['home_description'] }}</description>

        @foreach($manga_rss as $rss)
        @php
        $new = $metaConf;
        $replaces = [
            '%manga_name%' => $rss->name,
            '%manga_description%' => $rss->description,
            '%other_name%' => $rss->other_name,
            '%site_name%' => $new['site_name'],
        ];

        foreach ($replaces as $key => $value) {
            $new['manga_title'] =
             str_replace($key, $value, $new['manga_title']);
            $new['manga_description'] =
            str_replace($key, $value, $new['manga_description']);
        }
        @endphp

        <item>
            <title>{{ $new['manga_title'] }}</title>
            <link>{{ manga_url($rss) }}</link>
            <description>
                {{ strip_tags(!empty($rss->description) ? $rss->description : $new['manga_description']) }}
            </description>
            <guid>{{ manga_url($rss) }}</guid>
            <atom:link href="{{ manga_url($rss) }}" rel="self" type="application/rss+xml"/>
            <enclosure url="{{ $rss->cover }}" type="image/jpeg"/>
            <category>{{ $rss->name }}</category>
            <author>{{ $metaConf['site_name'] }}</author>
            <pubDate>{{ date('D, d M Y H:i:s O', strtotime($rss->last_update)) }}</pubDate>
        </item>
        @endforeach

    </channel>

</rss>