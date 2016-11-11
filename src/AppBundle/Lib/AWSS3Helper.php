<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Lib;

use Aws\S3\S3Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use AppBundle\Model\UploadFileInterface;

/**
 * Description of AWSS3Helper
 *
 * @author ks
 */
class AWSS3Helper {
    //put your code here
    private static $s3Client;
    private $container;
    private $tokenStorage;
    private static $initializated = false;

    protected static $AWS_ACCESS_KEY_ID;
    protected static $AWS_SECRET_ACCESS_KEY;
    protected static $S3_BUCKET;
    protected static $AWS_URL;
    const AWS_URL_TMP="https://s3-us-west-2.amazonaws.com/multiacademicoaustriaco";

    
   /**
     * @param TokenStorage $securityContext
     * @param ContainerInterface $container The container
     */
    public function __construct(TokenStorage $tokenStorage, ContainerInterface $container) {
        $this->tokenStorage = $tokenStorage;
        $this->container=$container;
        if (!self::$initializated){
            $this->init();
        }
    }
    
    public function init(){
        self::$AWS_ACCESS_KEY_ID=$this->container->getParameter('aws_access_key_id');
        self::$AWS_SECRET_ACCESS_KEY=$this->container->getParameter('aws_secret_access_key');
        self::$S3_BUCKET=$this->container->getParameter('s3_bucket');
        self::$AWS_URL=$this->container->getParameter('aws_url');
        self::$s3Client = new S3Client([
            'version' => 'latest',
            'region'  => 'us-west-2',
            'credentials' => [
                'key'    => self::$AWS_ACCESS_KEY_ID,
                'secret' => self::$AWS_SECRET_ACCESS_KEY,
            ],
        ]);
        self::$initializated=true;
    }

    public function getS3Client(){
        return self::$s3Client;
    }
    
    public function upLoadFile($key,$fileIn){
        return self::$s3Client->upload(self::$S3_BUCKET, $key, fopen($fileIn, 'rb'), 'public-read');
    }
    
    public function deleteFile($key){
        return self::$s3Client->deleteObject(array(
                                                    'Bucket' => self::$S3_BUCKET,
                                                    'Key'    => $key
                                                )); 
    }
    
    public function uploadFileFromEntity(UploadFileInterface $entity){
        
        
        if (null === $entity->getFile()) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        //var_dump($entity->getUploadDir(),$entity->getPath());
         try {
            // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
            $upload = $this->upLoadFile($entity->getUploadDir().'/'.$entity->getPath(), $entity->getFile()->getPathName());
            $entity->setWebPath($this->getWebPath($entity->getPath(),$entity->getUploadDir()));
            }catch(\Exception $e) {}             
        // check if we have an old image
        if (null!==$entity->getTemp()) {
            // delete the old image
            try{
            unlink($entity->getUploadRootDir().'/'.$entity->getTemp());
            }catch(\Exception $e)
            {}
            // clear the temp image path
            $entity->setTemp(null);
        }
        $entity->setFile();
    }
    
    public function removeFileFromEntity(UploadFileInterface $entity){
        //pendiente de implementar
        return;
    }
    
    /**
     * 
     * @param type $path
     * @param type $uploadDir
     * @return type
     */
    public function getWebPath($path,$uploadDir){
                
        return null === $path
            //? null
            ? null
            : self::$AWS_URL.'/'.$uploadDir.'/'.$path;
    
            } 
    }
