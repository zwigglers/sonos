<?php

namespace duncan3dc\Sonos\Tracks;

use duncan3dc\Sonos\Helper;

/**
 * Representation of a Google track.
 */
class Google2 extends Track
{
    const UNIQUE = "A0DvPDnows";
    const PREFIX = "x-sonos-http:" . self::UNIQUE;

    /**
     * Create a Google track object.
     *
     * @param string $uri The URI of the track or the Google ID of the track
     */
    public function __construct($uri)
    {
        # If this is a Google track ID and not a URI then convert it to a URI now
        if (substr($uri, 0, strlen(self::PREFIX)) !== self::PREFIX) {
            $uri = self::PREFIX . urlencode(":{$uri}.mp3");
        }

        parent::__construct($uri);
    }


    /**
     * Get the metadata xml for this track.
     *
     * @return string
     */
    public function getMetaData()
    {
        $uri = substr($this->uri, strlen(self::PREFIX));
        if ($pos = strpos($uri, ".mp3")) {
            $uri = substr($uri, 0, $pos);
        }

        return Helper::createMetaDataXml(Helper::TRACK_HASH . self::UNIQUE . "{$uri}", "-1", [
            "dc:title"      =>  "",
            "upnp:class"    =>  "object.item.audioItem.musicTrack",
        ], "38663");
    }
}
