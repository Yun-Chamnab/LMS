<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthService
{
    use ConsumesExternalService;

    /**
     * The base uri to consume the auth service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the auth service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.class.base_uri');
        $this->secret = config('services.class.secret');
    }

    /**
     * Obtain the full list of author from the author service
     * @return string
     */
    public function index()
    {
        return $this->performRequest('GET', 'api/class/');
    }

    /**
     * Create one author using the author service
     * @return string
     */
    public function obtainClass($data)
    {
        return $this->performRequest('POST', 'api/class/', $data);
    }
}