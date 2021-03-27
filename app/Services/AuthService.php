<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService
{
    use ConsumesExternalService;

    /**
     * The base uri to consume the auth service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the authors service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.auth.base_uri');
        $this->secret = config('services.auth.secret');
    }

    /**
     * Obtain the full list of author from the author service
     * @return string
     */
    public function obtainAuthors()
    {
        return $this->performRequest('GET', '/auth');
    }

    /**
     * Create one author using the author service
     * @return string
     */
    public function createAuthor($data)
    {
        return $this->performRequest('POST', '/auth', $data);
    }

    /**
     * Obtain one single author from the author service
     * @return string
     */
    public function obtainAuthor($auth)
    {
        return $this->performRequest('GET', "/authors/{$auth}");
    }

    /**
     * Update an instance of author using the author service
     * @return string
     */
    public function editAuthor($data, $auth)
    {
        return $this->performRequest('PUT', "/authors/{$auth}", $data);
    }

    /**
     * Remove a single author using the author service
     * @return string
     */
    public function deleteAuthor($auth)
    {
        return $this->performRequest('DELETE', "/authors/{$auth}");
    }
}