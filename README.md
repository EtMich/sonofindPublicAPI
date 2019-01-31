# sonofindPublicAPI
Code samples for the public SONOfind API

## Description
With the SONOfind public API, you can easily get access to a tracks metadata in XML format.
The format used is published at https://www.musicmetadata.org. 
The Schema is published at https://www.musicmetadata.org/mmdSchema/

## Accessing the API
The SONOfind public API is available on SONOfind systems. 
To use the API, you need the SONOfind trackcode for the track you need metadata for. The SONOfind trackcode can be found on the SONOfind systems and is also part of downloaded audio files.

The syntax for the API request is http(s)://<server>/mmd/<trackcode>

e.g. if you want to get the metadata for the trackcode SCD070012, the URL for our testserver would be

http://dev.sonofind.com/mmd/SCD070012

