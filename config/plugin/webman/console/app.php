<?php
return [
    'enable' => true,

    'build_dir' => BASE_PATH . DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR . 'target',

    'phar_filename' => env('APP_NAME', 'webman') . '.phar',

    'bin_filename' => env('APP_NAME', 'webman') . '.bin',

    'signature_algorithm' => Phar::SHA256, //set the signature algorithm for a phar and apply it. The signature algorithm must be one of Phar::MD5, Phar::SHA1, Phar::SHA256, Phar::SHA512, or Phar::OPENSSL.

    'private_key_file' => '', // The file path for certificate or OpenSSL private key file.

    'exclude_pattern' => '#^(?!.*(composer.json|/.github/|/.idea/|/.git/|/.setting/|/runtime/|/vendor-bin/|/build/|/vendor/webman/admin/))(.*)$#',

    'exclude_files' => [
        '.env', 'LICENSE', 'composer.json', 'composer.lock', 'start.php', env('APP_NAME', 'webman') . '.phar', env('APP_NAME', 'webman') . '.bin'
    ],

    'custom_ini' => '
memory_limit = 256M
    ',
];
