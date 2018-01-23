<?php
/**
 * Perform a HTTP or HTTPS curl call.
 */
class Curl {
    private static $_httpCode = null;

    public static function getHttpCode() {
        return self::$_httpCode;
    }

    public static function exec( $url, $queryString, $method, $headers = null, $auth = null, $timeout = null, $secure = null ) {
        $ch = curl_init();

        if ( $method == "POST" || $method == "PUT" || $method == "DELETE" ) {
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );

            if ( $method == "PUT" || $method == "DELETE" ) {
                curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $method );
            }

            if ( !empty( $queryString ) ) {
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $queryString );
            }
        } else {
            curl_setopt( $ch, CURLOPT_URL, $url . $queryString );
        }

        if ( !is_null( $headers ) ) {
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
        }

        if ( !is_null( $auth ) ) {
            curl_setopt( $ch, CURLOPT_USERPWD, $auth );
        }

        if ( !is_null( $timeout ) ) {
            curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
        }

        if ( !is_null( $secure ) ) {
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, $secure );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, $secure );
        }

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        $response = curl_exec( $ch );

        self::$_httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

        curl_close( $ch );

        return $response;
    }
}
