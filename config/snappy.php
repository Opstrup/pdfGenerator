<?php

return array(
    'pdf' => array(
        'enabled' => true,
        'binary' => base_path('vendor/bin/wkhtmltopdf.exe.bat'),
        'timeout' => false,
        'options' => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => base_path('vendor/bin/wkhtmltoimage.exe.bat'),
        'timeout' => false,
        'options' => array(),
    ),
);