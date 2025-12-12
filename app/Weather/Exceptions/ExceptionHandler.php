<?php

namespace Weather\Exceptions;

use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use GuzzleHttp\Exception\ServerException as GuzzleServerException;
use Throwable;

class ExceptionHandler
{
    public static function from(Throwable $e): WeatherHttpException
    {
        if ($e instanceof GuzzleRequestException) {
            return new RequestException(message: "Bad request: {$e->getMessage()}", previous: $e);
        }

        if ($e instanceof GuzzleClientException) {
            return new ClientException(message: "Client error: {$e->getMessage()}", previous: $e);
        }

        if ($e instanceof GuzzleServerException) {
            return new ServerException(message: "Server error: {$e->getMessage()}", previous: $e);
        }

        return new GenericException(message: "Unexpected HTTP error: {$e->getMessage()}", previous: $e);
    }
}
