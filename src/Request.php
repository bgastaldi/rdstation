<?php

namespace RDStation;

use RDStation\Exception\Exception;
use RDStation\Exception\InvalidContentTypeHeader;
use RDStation\Exception\InvalidDataType;
use RDStation\Exception\MalformedBodyRequest;
use RDStation\Exception\ResourceNotFound;
use RDStation\Exception\UnauthorizedRequest;

class Request
{
    public static function send($method, $url, array $data = array(), array $headers = array(), $verifySsl = true) {
        $ch = curl_init();

        if (strtoupper($method) == 'GET') {
            $url = sprintf('%s?%s', $url, http_build_query($data));
        } else {
            if (strtoupper($method) == 'POST') {
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            } else {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            }
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        if (count($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!$verifySsl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $response = curl_exec($ch);

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($status >= 400) {
            // exception
            switch ($status) {
                case Exception::BAD_REQUEST:
                    $exception = new MalformedBodyRequest();
                break;
                case Exception::NOT_FOUND:
                    $exception = new ResourceNotFound();
                break;
                case Exception::UNAUTHORIZED:
                    $exception = new UnauthorizedRequest();
                break;
                case Exception::UNPROCESSABLE_ENTITY:
                    $exception = new InvalidDataType();
                break;
                case Exception::UNSUPPORTED_MEDIA_TYPE:
                    $exception = new InvalidContentTypeHeader();
                break;
                default:
                    $exception = new Exception();
            }

            curl_close($ch);
            
            throw $exception;
        }

        $err = curl_errno($ch);
        if (0 !== $err) {
            curl_close($ch);
            throw new \Exception('CURL exception: ' . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}