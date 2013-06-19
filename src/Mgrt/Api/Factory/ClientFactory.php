<?php

namespace Mgrt\Api\Factory;

use Mgrt\Api\Client\HttpBasicClient;

class ClientFactory
{
    const DEFAULT_AUTHENTICATION = 'HTTP_BASIC';

    public static function create(array $options)
    {
        if (isset($options) && is_array($options)) {
            if (!isset($options['username'])) {
                throw new Exception("Username must be set", 1);
            }

            if (!isset($options['password'])) {
                throw new Exception("Password must be set", 1);
            }

            if (!isset($options['authentication'])) {
                $options['authentication'] = self::DEFAULT_AUTHENTICATION;
            }

            if (!isset($options['http_adapter'])) {
                $options['http_adapter'] = null;
            }

            switch ($options['authentication']) {
                case 'OAuth':
                    throw new Exception("Oauth authentication is not implemented yet.", 1);
                break;
                case 'HTTP_BASIC':
                default:
                    $client = new HttpBasicClient($options['http_adapter']);
                    $client->setUsername($options['username']);
                    $client->setPassword($options['password']);
                break;
            }

            return $client;

        } else {
            throw new Exception("No configuration given for client", 1);
        }
    }
}
