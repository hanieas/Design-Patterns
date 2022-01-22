<?php

interface IWeatherFinder
{
    public function getTemperature(): void;
}

class WeatherFinder implements IWeatherFinder
{

    private $cityName;

    public function __construct(string $cityName)
    {
        $this->cityName = $cityName;
    }

    public function getTemperature(): void
    {
        echo "The temperature in the $this->cityName is 100 celsius";
    }
}

class ZipCodeAPI
{
    private $zipCode;

    public function __construct(int $zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function getCityName()
    {
        echo "$this->zipCode To City Name and The name is Tehran \n";
        return 'Tehran';
    }
}

class WeatherAdapter implements IWeatherFinder
{

    private $zipCodeAPI;

    public function __construct(ZipCodeAPI $zipCodeAPI)
    {
        $this->zipCodeAPI = $zipCodeAPI;
    }

    public function getTemperature(): void
    {
        $cityName = $this->zipCodeAPI->getCityName();
        echo "The temperature in the $cityName is 100 celsius";
    }
}

function clientCode(IWeatherFinder $weatherFinder)
{
    $weatherFinder->getTemperature();
}

echo "We don't need to use adapter:\n";
$weatherFinder = new WeatherFinder('Tehran');
clientCode($weatherFinder);

echo "\n\n";

echo "We're using the adapter to convert zipcode to the city name:\n";
$ZipCodeAPI = new ZipCodeAPI(1);
$weatherFinder = new WeatherAdapter($ZipCodeAPI);
clientCode($weatherFinder);
