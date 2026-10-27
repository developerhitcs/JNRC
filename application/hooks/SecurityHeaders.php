<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SecurityHeaders {

    public function setHeaders()
    {
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("X-Frame-Options: SAMEORIGIN");

        header("Content-Security-Policy: 
            default-src 'self';
            script-src 'self';
            style-src 'self';
            img-src 'self' data:;
            font-src 'self';
            frame-ancestors 'self';
        ");
    }
}
