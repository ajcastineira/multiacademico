<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Lib;

use Aws\S3\S3Client;

/**
 * Description of AWSS3Helper
 *
 * @author ks
 */
class AWSS3Helper {
    //put your code here
    private $s3Client;
    const AWS_ACCESS_KEY_ID="AKIAJALXN45BGZRAUFZA";
    const AWS_SECRET_ACCESS_KEY="Gh7R6b6md6Pl9KxcDlXSSyseLNf3nHHsP3eurd2R";
    const S3_BUCKET="multiacademicoaustriaco";
    const AWS_URL="https://s3-us-west-2.amazonaws.com/multiacademicoaustriaco";
    
    public function __construct() {
        
        $this->s3Client = new S3Client([
            'version' => 'latest',
            'region'  => 'us-west-2',
            'credentials' => [
                'key'    => self::AWS_ACCESS_KEY_ID,
                'secret' => self::AWS_SECRET_ACCESS_KEY,
            ],
        ]);
    }
    
    public function getS3Client(){
        return $this->s3Client;
    }
    
    public function upLoadFile($key,$fileIn){
        return $this->s3Client->upload(self::S3_BUCKET, $key, fopen($fileIn, 'rb'), 'public-read');
    }
}
