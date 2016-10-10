<?php

namespace AppBundle\Model;

/**
 * Description of UploadFileEntity
 *
 * @author Rene Arias <renearias@arxis.la>
 */

use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class UploadFileEntity implements UploadFileInterface{
    
    private $webPath;
    
 //   private $archivo;
    
  //  private $file;

    private $temp;
    
    public function __construct() {
        
    }
    
    public function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    public function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents/files';
    }
    
    public function getWebPath()
    {
        //return $this->getArchivo()==null?null:(AWSS3Helper::AWS_URL_TMP.'/'.$this->getUploadDir().'/'.$this->getArchivo());
        return $this->webPath;
    }    
    abstract function getArchivo();
    abstract function setArchivo($archivo);
    abstract function setFile(UploadedFile $file = null);
    abstract function getFile();
    
    public function setWebPath($webPath)
    {
        $this->webPath = $webPath;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getTemp()
    {
      return $this->temp;
    }
    /**
     * 
     * @param type $temp
     * @return $this
     */
    public function setTemp($temp)
    {
      $this->temp=$temp;
      return $this;
    }
    
    /**
    * Set path
    *
    * @param string $path
    */
    public function setPath($path)
    {
    $this->setArchivo($path);
    return $this;
    }
    /**
    * Get path
    *
    * @return string
    */
    public function getPath()
    {
    return $this->getArchivo();
    }
    
    public function getAbsolutePath()
    {
        return null === $this->archivo
            ? null
            : $this->getUploadRootDir().'/'.$this->archivo;
    }
    
}
