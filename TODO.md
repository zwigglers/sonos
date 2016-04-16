How is caching handled in DeviceCollection? Do we need to handle multicast address and network interface?
What about manually added devices? Should we cache those?

There's a bug in 1.* where the cache is cleared from the network, but not the speakers, so if a speakers meta data changes it isn't re-fetched

Time inconsistencies, some places accept seconds, but return string representations

AVTransport
  ReorderTracksInQueue
  ReorderTracksInSavedQueue
