<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="3.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">
    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <title><xsl:value-of select="/rss/channel/title"/> RSS Feed</title>
                <meta charset="UTF-8" />
                <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1" />
                <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,shrink-to-fit=no" />
                <style type="text/css">
                    body {
                        font-family: sans-serif;
                        font-size: 1rem;
                        line-height: 1.5;
                        color: #333;
                        background-color: #fff;
                    }
                    header {
                        padding: 1rem;
                        background-color: #f5f5f5;
                    }
                    header h1 {
                        margin: 0;
                        font-size: 1.5rem;
                        font-weight: 400;
                        line-height: 1.2;
                        color: inherit;
                        text-align: center;
                    }
                    header h2 {
                        margin: 0;
                        font-size: 1.25rem;
                        font-weight: 400;
                        line-height: 1.2;
                        color: inherit;
                        text-align: center;
                    }
                    header p {
                        margin: 0;
                        font-size: 1rem;
                        font-weight: 400;
                        line-height: 1.5;
                        color: inherit;
                        text-align: center;
                    }
                    header a {
                        display: block;
                        margin: 0 auto;
                        padding: 0.5rem 1rem;
                        font-size: 1rem;
                        font-weight: 400;
                        line-height: 1.5;
                        color: #fff;
                        text-align: center;
                        text-decoration: none;
                        background-color: #007bff;
                        border-radius: 0.25rem;
                    }
                    main {
                        padding: 1rem;
                    }
                    main h2 {
                        margin: 0;
                        font-size: 1.25rem;
                        font-weight: 400;
                        line-height: 1.2;
                        color: inherit;
                    }
                    article {
                        margin-bottom: 1rem;
                    }
                    article h3 {
                        margin: 0;
                        font-size: 1.25rem;
                        font-weight: 400;
                        line-height: 1.2;
                        color: inherit;
                    }
                    article h3 a {
                        color: inherit;
                        text-decoration: none;
                    }
                    article footer {
                        margin-top: 0.5rem;
                        font-size: 0.875rem;
                        color: #6c757d;
                    }
                    article footer time {
                        font-weight: 400;
                    }
                    
                </style>
            </head>
            <body>
                <header>
                    <h1>RSS Feed</h1>
                    <h2>
                        <xsl:value-of select="/rss/channel/title"/>
                    </h2>
                    <p>
                        <xsl:value-of select="/rss/channel/description"/>
                    </p>
                    <a hreflang="en" target="_blank">
                        <xsl:attribute name="href">
                            <xsl:value-of select="/rss/channel/link"/>
                        </xsl:attribute>
                        Visit Website &#x2192;
                    </a>
                </header>
                <main>
                    <h2>Recent Posts</h2>
                    <xsl:for-each select="/rss/channel/item">
                        <article>
                            <h3>
                                <a hreflang="en" target="_blank">
                                    <xsl:attribute name="href">
                                        <xsl:value-of select="link"/>
                                    </xsl:attribute>
                                    <xsl:value-of select="title"/>
                                </a>
                            </h3>
                            <footer>
                                Published:
                                <time>
                                    <xsl:value-of select="pubDate" />
                                </time>
                            </footer>
                        </article>
                    </xsl:for-each>
                </main>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>