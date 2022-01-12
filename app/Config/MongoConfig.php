<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class MongoConfig extends BaseConfig
{
    public $dbInfo = [];

    public function __construct()
    {
        $this->dbInfo = [
            'default' => (object)[
                'db' => 'vr_destination_mongo', //your database
                'hostname' => "127.0.0.1",//127.0.0.1 if you use remote server you should change host address
                'userName' => "vrAdmin",
                'password' => "admin#123456",
                'prefix' => '',
                'port' => "27017",//27017 if you use different port you should change port address
                'srv' => 'mongodb',//mongodb+srv
                //SCRAM-SHA-256 - SCRAM-SHA-1
                'authMechanism' => "SCRAM-SHA-256",
                'db_debug' => TRUE,
                'write_concerns' => (int)1,
                'journal' => FALSE,
                'read_preference' => 'primary',
                'read_concern' => 'local', //'local', 'majority' or 'linearizable'
                'ca_file'=>[]//['ca_file' => '/usr/local/etc/openssl/cert.pem']
            ]
        ];
    }
}
