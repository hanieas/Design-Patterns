<?php

interface Downloader
{
    public function download(string $url): string;
}

class SimpleDownloader implements Downloader
{
    public function download(string $url): string
    {
        echo "Downloading a file from the url\n";
        $result = file_get_contents($url);
        echo "Downloaded bytes: " . strlen($result) . "\n";

        return $result;
    }
}

class CachingDownloader implements Downloader
{

    /**
     * @var Downloader
     */
    private $downloader;

    /**
     * @var array
     */
    private $cache = [];

    /**
     * @param  Downloader|SimpleDownloader $downloader
     * @return void
     */
    public function __construct(SimpleDownloader $downloader)
    {
        $this->downloader = $downloader;
    }

    /**
     * @param  string $url
     * @return string
     */
    public function download(string $url): string
    {
        if (!isset($this->cache[$url])) {
            echo 'CachProxy MISS';
            $result = $this->downloader->download($url);
            $this->cache[$url] = $result;
        } else {
            echo "CachProxy HIT. Retriving result from cache";
        }
        return $this->cache[$url];
    }
}

function clientCode(Downloader $downloader, string $url)
{
    $result = $downloader->download($url);

    // Duplicate download requests could be cached for a speed gain.

    $result = $downloader->download($url);
}

$url = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHga7Z-h8-1PEdTarEMitM4wqZcOi_-RdfYA&usqp=CAU';
echo "Executing client code with real subject:\n";
$realSubject = new SimpleDownloader();
clientCode($realSubject, $url);

echo "\n";

echo "Executing the same client code with a proxy:\n";
$proxy = new CachingDownloader($realSubject);
clientCode($proxy, $url);
