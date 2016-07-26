<?php

namespace AppBundle\Lib;

use Kreait\Firebase\Firebase;
use Firebase\Token\TokenGenerator;
use Firebase\JWT\JWT;

/**
 * Description of Token
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class FireBaseUtil {
    public static function create_custom_token($uid,$email) {
        $service_account_email = "multiacademicoapp@multiacademico.iam.gserviceaccount.com";
        $private_key = "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCV/UDrOnYXWAZW\nrVfxbalcXAvXEEKJTbORzYdYN1rMKdbPr/pdM/nmEUGP0YtdZPxYFxa3yVaoNcm6\ntXgGskWiqiqgtCt8Ij+dQ3XAHjMhUkb+3qs9DNw8knE3WjR/szFb0juuNebWKG1A\n3oCb4l2aiAjvxdxOpookJWj/4zZSbe7e8hrDYEsEEibJqM8GnzHl4emaeN1O5Z3S\np4cnd4s4tlU1pgbv+5PVK4d0ujt3WR19rnbTXZ+O95mrQjN12wRVURy0BRYJGYQ5\nmYAqtEFLCf4Dwr55XbYcNO4HhmtDsSdLbVuBH+UOQD0Ni0Stoshb9MYju4d/spVU\nAi5aUfxZAgMBAAECggEANxpkmEbRDcB0C7IBZhwgpWLXorpBh4n5V66Hc7xaajlQ\nxtpjA4zN2V0rlfeo2LX6Ey7gVMLuSDwCkcqLfwJNnPYhVQr8Es3OSyt2fg9aP3qn\nxIjvpi0sWECAwZItSWD+2DoDXPxGgxU1FijoXNysANLLXbN2PZrnk2H/EktaMKvM\noLjk84HUdkZXdncIX4sYuzGNaiV21Vmq+CB5/+i7AqS4EpwNEkqEzSt1s6/4fItB\nu4R5TbnmSKcuOFU44+j8NwFIMZqYJ3Mvgbu3XZ4mCQOn6F78XqL3bQgTP5PDuLtI\n/CJvtmf6tKSAEDFRfa8iLDjzDJ7UeygWob2GSC67VQKBgQDGsf/GQpCAzbCGGWb8\n/TvSxP0Nqf5OhmIH998AqMxswRhgDhczy2Bb8qF1eJ0Q+6RD1DiwYwiS6iYMZe4+\n2plR/GKSGxJF6JOn7epi8dDOJHGfTNQSTO7uK5B5g25nnkT23NWQb6lWlENOpQEk\nSVL7ZGMCv99EPoUAhoD2H8pqWwKBgQDBPzUw6WgMY2mNPl3Wxc17R8jrw4lF/qkH\nosFxV7E+hTrFAb9KleEYLpShNuIvcXLiCDyICMIjqE0VCwZjffGqAvZarYDjQ+IW\nd5rQx/9HZWTzp7UnN62sAiCsG09SVRqu2/ct8+BA6oKYo4kZObjBkK//1IDCBBv3\nImooSyXqWwKBgGya8sF9tNqSk4BY9jAmgsKMJf2IA5cMYR0V4XDM0yBG03n9ebU3\n3y2jC5nYGZIk2f6xS2MuXotfLPjt5jG47sEfgQl3fp9zpvHNW6ZFoupqhSibp/dw\n0dChQ1EIBBrjKbL9tkZCon7Of5PHIT6iTZdXob7o/bKhsbU9z9O4QL2tAoGBAJh3\ngUUM8n3LtYyt5yW7vIqGsZxqExV5fe07WTpOwNYeEac74Kw9InKM1dF4Vu6tqMFz\nVCbUGjA96ksu/qRiytejLLGQcL9eYLPvO+N72AqBkiu3ZvMBN/IdX5/KkEPaR4os\nnJHR913gaJd7d4DCjOWTfXjwNYJd8Z6DtZQC7nA/AoGBAIviMpHSLjgK0T7grPfA\nswry3kTQmmmUvrFeqyIrEJlBC1dTtAKCxmK9yS7f7JBiRjTcy9VIq/zy7T4l317z\nXnbh+VJRjkSpAePavKbTJmrufKm7Qokf02Y08yFehTV0HahAOyaaRRTkfWEFD5Qn\nng9IRmx5163Y/uyRHyqtmFTg\n-----END PRIVATE KEY-----\n";

        $now_seconds = time();
          $payload = array(
            "iss" => $service_account_email,
            "sub" => $service_account_email,
            "aud" => "https://identitytoolkit.googleapis.com/google.identity.identitytoolkit.v1.IdentityToolkit",
            "iat" => $now_seconds,
            "exp" => $now_seconds+(60*60),  // Maximum expiration time is one hour
            "uid" => $uid,
            "claims" => array(
              //"premium_account" => $is_premium_account//,
               "email"=>$email,
            )
          );
          return JWT::encode($payload, $private_key, "RS256");
        }
}
