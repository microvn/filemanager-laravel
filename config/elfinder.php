<?php

 // HoangHn - Callback Reformat name of file
function renameCallback($cmd, $result, $args, $elfinder, $volume)
{
    $files = $result['added'];
    foreach ($files as $file) {
        $name = $file['name'];
        $webalized = sanitizeFileName($file['name']);
        if (strcmp($name, $webalized) != 0) {
            $arg = array('target' => $file['hash'], 'name' => $webalized);
            $elfinder->exec('rename', $arg);
        }
    }
    return true;
};

// HoangHn - Function Clean name of file
function sanitizeFileName($filename)
{
    $filename = iconv('UTF-8', 'ASCII//TRANSLIT', $filename);
    $filename = strtolower($filename);
    $filename = strtr($filename, array('&' => '_', '"' => '_', '&' . '#039;' => '_', '<' => '_', '>' => '_', '\'' => '_'));
    $filename = preg_replace('/^[^a-z0-9]{0,}(.*?)[^a-z0-9]{0,}$/si', '\\1', $filename);
    $filename = preg_replace('/[^a-z0-9.\-]/', '_', $filename);
    $filename = preg_replace('/[\-]{2,}/', '_', $filename);
    return str_replace(array('\\', '/', ':', '*', '?', '"', '<', '>', '|', ' '), '_', $filename);

}

// HoangHn - Callback Clean name of file
function cleanNameCallback(&$path, &$name, $src, $elfinder, $volume)
{
    $ext = '';
    if ($pos = strrpos($name, '.')) {
        $ext = substr($name, $pos);
    }
    $name = sanitizeFileName($name); // With your preferred hashing method
}

return array(

    /*
    |--------------------------------------------------------------------------
    | Upload dir
    |--------------------------------------------------------------------------
    |
    | The dir where to store the images (relative from public)
    |
    */
    'dir' => null,

    /*
    |--------------------------------------------------------------------------
    | Filesystem disks (Flysytem)
    |--------------------------------------------------------------------------
    |
    | Define an array of Filesystem disks, which use Flysystem.
    | You can set extra options, example:
    |
    | 'my-disk' => [
    |        'URL' => url('to/disk'),
    |        'alias' => 'Local storage',
    |    ]
    */
    'disks' => null,

    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
    | The default group settings for the elFinder routes.
    |
    */

    'route' => [
        'prefix' => 'elfinder',
        'middleware' => ['web'], //Set to null to disable middleware filter
    ],

    /*
    |--------------------------------------------------------------------------
    | Access filter
    |--------------------------------------------------------------------------
    |
    | Filter callback to check the files
    |
    */

    'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',

    /*
    |--------------------------------------------------------------------------
    | Roots
    |--------------------------------------------------------------------------
    |
    | By default, the roots file is LocalFileSystem, with the above public dir.
    | If you want custom options, you can set your own roots below.
    |
    */

    'roots' => array(
        array(
            'driver' => 'LocalFileSystem',
            'path' => '',
            'startPath' => '',
            'dirMode' => 0755,
            'fileMode' => 0644,
            'URL' => env('DOMAIN_IMAGE'),
            'rememberLastDir' => false,
            'uploadAllow' => array('image/jpg', 'image/png', 'image/gif'),
            'mimeDetect' => 'mime_content_type',
            'acceptedName' => '/\.(jpg|jpeg|png|gif)$|^[^\.]+$/',
            'uploadOverwrite' => false,
            'uploadMaxSize' => '5M',
            'accessControl' => 'access',
            'attributes' => array(
                array(
                    'pattern' => '!^/.tmb!',
                    'hidden' => true
                )
            )

        )

    ),

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | These options are merged, together with 'roots' and passed to the Connector.
    | See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1
    |
    */

    'options' => array(
        'bind' => array(
            'upload.presave mkdir.pre' => array(
                'cleanNameCallback'
            ),
            'mkdir mkfile rename duplicate upload rm paste' => 'renameCallback',


            'upload.presave' => array(
//                'Plugin.Watermark.onUpLoadPreSave'
            )
        ),
        'plugin' => array(
//            'Watermark' => array(
//                'enable' => true,       // For control by volume driver
//                'source' => 'logo.png', // Path to Water mark image
//                'marginRight' => 5,          // Margin right pixel
//                'marginBottom' => 5,          // Margin bottom pixel
//                'quality' => 95,         // JPEG image save quality
//                'transparency' => 70,         // Water mark image transparency ( other than PNG )
//                'targetType' => IMG_GIF | IMG_JPG | IMG_PNG | IMG_WBMP, // Target image formats ( bit-field )
//                'targetMinPixel' => 200,        // Target image minimum pixel size
//                'interlace' => IMG_GIF | IMG_JPG, // Set interlacebit image formats ( bit-field )
//                'offDropWith' => [4, 8, 2, 1]       // To disable it if it is dropped with pressing the meta key
//                // Alt: 8, Ctrl: 4, Meta: 2, Shift: 1 - sum of each value
//                // In case of using any key, specify it as an array
//            )
        )
    ),
);


