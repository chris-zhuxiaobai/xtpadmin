<?php
return [
    /*
    |--------------------------------------------------------------------------
    | CAS Hostname
    |--------------------------------------------------------------------------
    | Example: 'cas.myuniv.edu'.
    */
    'cas_hostname'        => env('CAS_HOSTNAME', '10.29.226.162'),

    /*
    |--------------------------------------------------------------------------
    | CAS Authorized Hosts
    |--------------------------------------------------------------------------
    | Example: 'cas.myuniv.edu'.  This is used when SAML is active and is
    | recommended for protecting against DOS attacks.  If using load
    | balanced hosts, then separate each with a comma.
    */
    'cas_real_hosts'      => env('CAS_REAL_HOSTS', '10.29.226.162'),


    /*
    |--------------------------------------------------------------------------
    | Customize CAS Session Cookie Name
    |--------------------------------------------------------------------------
    */
    'cas_session_name'    => env('CAS_SESSION_NAME', 'CASAuth'),

    /*
    |--------------------------------------------------------------------------
    | Laravel has it's own authentication sessions. Unless you want phpCAS
    | to manage the session, leave this set to false.  Note that the
    | middleware and redirect classes will be handling removal
    | of the Laravel sessions when this is set to false.
    |--------------------------------------------------------------------------
    */
    'cas_control_session' => env('CAS_CONTROL_SESSIONS', true),

    /*
    |--------------------------------------------------------------------------
    | Enable using this as a cas proxy
    |--------------------------------------------------------------------------
    */
    'cas_proxy'           => env('CAS_PROXY', false),

    /*
    |--------------------------------------------------------------------------
    | Cas Port
    |--------------------------------------------------------------------------
    | Usually 443
    */
    'cas_port'            => env('CAS_PORT', 30080),

    /*
    |--------------------------------------------------------------------------
    | CAS URI
    |--------------------------------------------------------------------------
    | Sometimes is /cas
    */
    'cas_uri'             => env('CAS_URI', '/cas'),

    /*
    |--------------------------------------------------------------------------
    | CAS Validation
    |--------------------------------------------------------------------------
    | CAS server SSL validation: 'self' for self-signed certificate, 'ca' for
    | certificate from a CA, empty for no SSL validation.
    |
    | VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL
    */
    'validation'          => env('CAS_VALIDATION', ''),

    /*
    |--------------------------------------------------------------------------
    | CA Certificate
    |--------------------------------------------------------------------------
    | Path to the CA certificate file.  For production use set
    | the CA certificate that is the issuer of the cert
    */
    'cert'                => env('CAS_CERT', ''),

    /*
    |--------------------------------------------------------------------------
    | CN Validation (if you are using CA certs)
    |--------------------------------------------------------------------------
    | If for some reason you want to disable validating the certificate
    | intermediaries, here is where you can.  Recommended to leave
    | this set with default (true).
    */
    'cas_validate_cn'     => env('CAS_VALIDATE_CN', false),

    /*
    |--------------------------------------------------------------------------
    | CAS Login URI
    |--------------------------------------------------------------------------
    | Empty is fine
    */
    'cas_login_url'       => env('CAS_LOGIN_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | CAS Logout URI
    |--------------------------------------------------------------------------
    */
    'cas_logout_url'      => env('CAS_LOGOUT_URL', 'http://10.29.226.162:30080/cas/logout'),

    /*
    |--------------------------------------------------------------------------
    | CAS Logout Redirect Services
    |--------------------------------------------------------------------------
    | If your server supports redirection services, enter the redirect url
    | in this section.  If left blank, it will default to disabled.
    */
    'cas_logout_redirect' => env('CAS_LOGOUT_REDIRECT', 'http://10.25.26.225:8080/'),

    /*
    |--------------------------------------------------------------------------
    | CAS Successful Logon Redirection Url
    |--------------------------------------------------------------------------
    | By default, CAS will assume that the user should be redirected to the
    | page in which the call was initiated.  You can override this method
    | and force the user to be redirected to a specific URL here.
    */
    'cas_redirect_path'   => env('CAS_REDIRECT_PATH', 'http://10.25.26.225:8080/home'),

    /*
    |--------------------------------------------------------------------------
    | CAS Supports SAML 1.1, allowing you to retrieve more than just the
    | user identifier.  If your CAS authentication service supports
    | this feature, you may be able to retrieve user meta data.
    |--------------------------------------------------------------------------
    */
    'cas_enable_saml'     => env('CAS_ENABLE_SAML', false),

    /*
    |--------------------------------------------------------------------------
    | Enable PHPCas Debug Mode
    | Options are:
    | 1) true (defaults logfile creation to /tmp/phpCAS.log)
    | 2) 'path/to/logfile'
    | 3) false
    |--------------------------------------------------------------------------
    */
    'cas_debug'           => env('CAS_DEBUG', true),


    /*
    |--------------------------------------------------------------------------
    | Enable Verbose error messages. Not recommended for production.
    | true | false
    |--------------------------------------------------------------------------
    */
    'cas_verbose_errors'  => env('CAS_VERBOSE_ERRORS', true),

    /*
    |--------------------------------------------------------------------------
    | This will cause CAS to skip authentication and assume this user id.
    | This should only be used for developmental purposes.  getAttributes()
    | will return null in this condition.
     */
    'cas_masquerade'      => env('CAS_MASQUERADE', 'xtpadmin')
];