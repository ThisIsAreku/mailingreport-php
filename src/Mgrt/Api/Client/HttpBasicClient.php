<?php

namespace Mgrt\Api\Client;

use Mgrt\Api\Client\MRApiClient;

class HttpBasicClient extends MRApiClient
{
    /**
     * @var string
     */
    private $username = null;

    /**
     * @var string
     */
    private $password = null;

    /**
     * set Authentification user name
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->httpAdapter->setUsername($username);

        return $this;
    }

    /**
     * Set the authentification password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->httpAdapter->setPassword($password);

        return $this;
    }
}
