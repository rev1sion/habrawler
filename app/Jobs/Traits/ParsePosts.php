<?php

namespace App\Jobs\Traits\ParsePosts;

use App\Models\Post\Post;
use App\Models\Tag\Tag;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Http;


trait ParsePosts
{
    static function getHtml($url)
    {
        $response = Http::get($url);
        if (!$response->successful()) abort(404);
        return $response->body();
    }

    static function collectPosts($html, $fields = [])
    {
        libxml_use_internal_errors(true);
        $dom = new DomDocument;
//        $dom->loadHtmlFile($html);
        $dom->loadHTML($html);
        $xpath = new DomXPath($dom);
        $nodes = $xpath->query('//a[contains(@class,"post__title_link")]');

//        todo how in laravel bulk create

        $i = 0;
        foreach (@$nodes as $node) {
            $fields[] = [
                'title' => $node->textContent,
                'url' => $node->getAttribute('href')
            ];

            if ($i == 5)
                break;
            $i++;
        }
//        if ($nodes->length) {
//            echo $nodes[0]->getAttribute('href');
//        }
        return $fields;
    }

    static function collectBody($html)
    {
        $dom = new DomDocument;
        $dom->loadHTML($html);
        $xpath = new DomXPath($dom);
        $nodes = $xpath->query('//div[contains(@class,"post__body_full")]');
        if (!$nodes)
            return '';
        return $dom->saveHtml($nodes[0]);
    }

    static function collectTags($html)
    {
        $dom = new DomDocument;
        $dom->loadHTML($html);
        $xpath = new DomXPath($dom);
        $nodes = $xpath->query('//a[contains(@class,"hub-link")]');

        $tags = [];
        foreach (@$nodes as $node) {
            $tags[] = ['name' => $node->textContent];
        }
        return $tags;
    }
}
