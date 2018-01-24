<?php

namespace AppBundle\Service;

use GuzzleHttp\Client;

/**
 * Class ADEService
 */
class ADEService
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getProjects()
    {
    }

    public function getResources()
    {
    }

    public function getResource()
    {
    }
}
