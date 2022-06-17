# M3u Parser
[![License](https://img.shields.io/github/license/optimumsage/m3u-parser-php)](https://packagist.org/packages/optimumsage/m3u-parser-php)

This library helps you parse m3u files from url or text.

## Install
`composer require optimumsage/m3u-parser-php`

## Usage
```
use OptimumSage\M3uParser\M3uParser;
...
$data = M3uParser::fromUrl(['https://iptv-org.github.io/iptv/categories/animation.m3u', 'https://iptv-org.github.io/iptv/categories/business.m3u'])->get();
$data = M3uParser::fromUrl('https://iptv-org.github.io/iptv/index.m3u')->get(); // returns stdClass

$data = M3uParser::fromUrl('https://iptv-org.github.io/iptv/index.m3u')->toArray(); // return array
$data = M3uParser::fromUrl('https://iptv-org.github.io/iptv/index.m3u')->toJson(); // return json
```
