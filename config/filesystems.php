<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],

        'digitalocean' => [
            'driver' => 's3',
            'key' => env('DIGITALOCEAN_SPACES_KEY', 'PUBIH7KKSUZ6D2ZZTBTK'),
            'secret' => env('DIGITALOCEAN_SPACES_SECRET', 'yPBC/BQ5a/06vb/0c/GG8sZPkzHPlJnuucc731pmMSI'),
            'endpoint' => env('DIGITALOCEAN_SPACES_ENDPOINT', 'https://sgp1.digitaloceanspaces.com'),
            'region' => env('DIGITALOCEAN_SPACES_REGION', 'sgp1'),
            'bucket' => env('DIGITALOCEAN_SPACES_BUCKET', 'sobat'),
        ],

        'wasabi' => [
            'driver' => 's3',
            'key' => 'YZF1REO1GREGMW7DHR1X',
            'secret' => '0wvl1rUFZrd7K0IWhwgsWaMXqIeR2RlKmBACbNwu',
            'endpoint' => 'https://s3.ap-southeast-1.wasabisys.com',
            'region' => 'ap-southeast-1',
            'bucket' => 'sobatstorage',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
