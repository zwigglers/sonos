<?php

namespace duncan3dc\Sonos\Tracks;

use duncan3dc\DomParser\XmlElement;
use duncan3dc\Sonos\Interfaces\ControllerInterface;

/**
 * Factory for creating Track instances.
 */
class Factory
{
    /**
     * @var ControllerInterface $controller A Controller instance to communicate with.
     */
    protected $controller;


    /**
     * Create an instance of the Factory class.
     *
     * @param ControllerInterface $controller A Controller instance to communicate with
     */
    public function __construct(ControllerInterface $controller)
    {
        $this->controller = $controller;
    }


    /**
     * Get the name of the Track class that represents a URI.
     *
     * @param string $uri The URI of the track
     *
     * @return string
     */
    protected function guessTrackClass(string $uri): string
    {
        $classes = [
            Spotify::class,
            Google::class,
            Deezer::class,
        ];
        foreach ($classes as $class) {
            if (substr($uri, 0, strlen($class::PREFIX)) === $class::PREFIX) {
                return $class;
            }
        }

        if (substr($uri, 0, 17) === "x-sonosapi-stream") {
            return Stream::class;
        }

        return Track::class;
    }


    /**
     * Create a new Track instance from a URI.
     *
     * @param string $uri The URI of the track
     *
     * @return Track
     */
    public function createFromUri(string $uri): Track
    {
        $class = $this->guessTrackClass($uri);

        return new $class($uri);
    }


    /**
     * Create a new Track instance from a URI.
     *
     * @param XmlElement $xml The xml element representing the track meta data.
     *
     * @return Track
     */
    public function createFromXml(XmlElement $xml): Track
    {
        $uri = (string) $xml->getTag("res");
        $class = $this->guessTrackClass($uri);

        return $class::createFromXml($xml, $this->controller);
    }
}
