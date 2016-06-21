<?php

return array(

    'appNameIOS'     => array(
        'environment' =>'development',
        'certificate' =>public_path().'/push/pushcert.pem',
        'passPhrase'  =>'',
        'service'     =>'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'production',
        'apiKey'      =>'yourAPIKey',
        'service'     =>'gcm'
    )

);