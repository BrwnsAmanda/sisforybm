<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'cloud' => [
        'driver' => 'supabase',
        'url' => env('SUPABASE_URL'),
        'bucket' => env('SUPABASE_BUCKET'),
        'key' => env('SUPABASE_KEY'),
    ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'supabase' => [
    'driver' => 'supabase',
    'url' => env('SUPABASE_URL'),
    'bucket' => env('SUPABASE_BUCKET'),
    'key' => env('SUPABASE_KEY'),
],

//'supabase_s3' => [
   // 'driver' => 's3',
   // 'key' => env('SUPABASE_KEY'),
   // 'secret' => env('SUPABASE_SECRET'),
  //  'region' => env('SUPABASE_REGION', 'us-east-1'),
  //  'bucket' => env('SUPABASE_BUCKET'),
   // 'endpoint' => env('SUPABASE_ENDPOINT', 'https://upurynpcspgmoblokxec.storage.supabase.co/storage/v1/s3'),
   // 'use_path_style_endpoint' => true,
//],

// config/filesystems.php

'supabase_s3' => [
    'driver' => 's3',
    // HAPUS PENGGUNAAN AWS_ACCESS_KEY_ID DI SINI
    'key' => '', // Pastikan ini kosong atau hapus baris ini
    'secret' => env('AWS_SECRET_ACCESS_KEY'), // Biarkan token JWT Service Role Key di sini

    'region' => env('AWS_DEFAULT_REGION'), // Sekarang sudah ap-southeast-1
    'bucket' => env('AWS_BUCKET'),

    'endpoint' => env('AWS_ENDPOINT'),
    'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', true),
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
            'throw' => false,
            'report' => false,
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
