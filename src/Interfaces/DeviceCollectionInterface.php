<?php

namespace duncan3dc\Sonos\Interfaces;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use duncan3dc\Sonos\Device;
use duncan3dc\Sonos\Interfaces\SpeakerInterface;

/**
 * Manage a group of devices.
 */
interface DeviceCollectionInterface extends LoggerAwareInterface
{


    /**
     * Get the logger object to use.
     *
     * @return LoggerInterface $logger The logging object
     */
    public function getLogger(): LoggerInterface;


    /**
     * Get all the devices from this collection.
     *
     * @return Device[]
     */
    public function getDevices(): array;


    /**
     * Set the network interface to use for SSDP discovery.
     *
     * See the documentation on IP_MULTICAST_IF at http://php.net/manual/en/function.socket-get-option.php
     *
     * @var string|int $networkInterface The interface to use
     *
     * @return self
     */
    public function setNetworkInterface($networkInterface): DeviceCollectionInterface;


    /**
     * Get the network interface currently in use
     *
     * @return string|int|null The network interface name
     */
    public function getNetworkInterface();


    /**
     * Get all the devices on the current network.
     *
     * @return void
     */
    public function discoverDevices(string $address = "239.255.255.250");


    /**
     * Add an ip address to the cache of the collection.
     *
     * @param string $ip The address to add
     *
     * @return self
     */
    public function addIp(string $ip): DeviceCollectionInterface;


    /**
     * Empty the collection.
     *
     * @return self
     */
    public function clear(): DeviceCollectionInterface;


    /**
     * Get all the speakers for these devices.
     *
     * @return SpeakerInterface[]
     */
    public function getSpeakers(): array;


    /**
     * Reset any previously gathered speaker information.
     *
     * @return self
     */
    public function clearTopology(): DeviceCollectionInterface;
}
