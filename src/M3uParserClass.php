<?php

namespace OptimumSage\M3uParser;

class M3uParserClass
{
    private $result;
    /**
     * Class constructor.
     *  
     * @param  string  $m3uContent
     * @param  string  $url
     * @return array
     */
    public function __construct($m3uContent, $url = null)
    {
        $this->parseM3u($m3uContent, $url);
    }

    /**
     * Get the result in stdClass.
     *
     * @return stdClass
     */
    public function get()
    {
        return $this->result;
    }

    /**
     * Get the result in stdClass.
     *
     * @return int
     */
    public function count()
    {
        return count($this->result);
    }

    /**
     * Get the result in array.
     *
     * @return array
     */
    public function toArray()
    {
        return (array) $this->result;
    }

    /**
     * Get the result in json.
     *
     * @return array
     */
    public function toJson()
    {
        return json_encode($this->result);
    }

    /**
     * Parse m3u content.
     *
     * @param  String  $m3uContent
     * @param  String  $url
     * @return array
     */
    private function parseM3u($m3uContent, $url)
    {
        $regex = '/#EXTINF:(.+?)[,]\s?(.+?)[\r\n]+?((?:https?|rtmp):\/\/(?:\S*?\.\S*?)(?:[\s)\[\]{};"\'<]|\.\s|$))/';
        $attributes = '/([a-zA-Z0-9\-]+?)="([^"]*)"/';

        preg_match_all($regex, $m3uContent, $matches);

        $this->result = new \stdClass();
        if (empty($matches[0])) {
            throw new \ErrorException('Cannot parse the m3u content. Regex found no match.');
        }
        $count = 0;
        foreach ($matches[0] as $list) {
            preg_match($regex, $list, $matchFurther);
            $mediaLink = preg_replace("/[\n\r]/", "", $matchFurther[3]);
            $mediaLink = preg_replace('/\s+/', '', $mediaLink);

            $record = new \stdClass();
            $record->title = $matchFurther[2];
            $record->link = $mediaLink;

            if ($url) {
                $record->playlist = $url;
            }

            preg_match_all($attributes, $list, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $record->{$match[1]} = $match[2];
            }

            $this->result->{$count} = $record;
            $count++;
        }
    }
}
