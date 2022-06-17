<?php

namespace OptimumSage\M3uParser;

class M3uParser
{
    /**
     * Parse m3u content from url.
     *
     * @param  string|array  $url
     * @return array
     */
    public static function fromUrl($url)
    {
        if (is_array($url)) {
            $mergedContent = "";
            foreach ($url as $singleUrl) {
                try {
                    $m3uFileContent = file_get_contents($singleUrl);
                    $mergedContent .= "\n" . $m3uFileContent;

                } catch (\Exception$e) {
                    // Nothing to do here
                }

            }
            return (new M3uParserClass($mergedContent));
        }

        $m3uFileContent = file_get_contents($url);
        return (new M3uParserClass($m3uFileContent, $url));
    }

    /**
     * Parse m3u content from text.
     *
     * @param  string  $stringContent
     * @return array
     */
    public static function fromstring($stringContent)
    {
        return (new M3uParserClass($stringContent));
    }

    /**
     * Parse m3u content from text.
     *
     * @param  string  $url
     * @return boolean
     */
    public static function isUrlValid($url)
    {
        list($status) = get_headers($url);
        if (str_contains($status, '200') || str_contains($status, '201')) {
            return true;
        }
        return false;
    }
}
