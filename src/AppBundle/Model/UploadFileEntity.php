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
    
    private $archivo;
    
    private $file;

    private $temp;
    
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
        return $this->webPath;
    }    
    
    public function setWebPath($webPath)
    {
        $this->webPath = $webPath;
        return $this;
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->archivo)) {
            // store the old name to delete after the update
            $this->temp = $this->archivo;
            $this->archivo= null;
        } else {
            $this->archivo = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
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
    $this->archivo = $path;
    }
    /**
    * Get path
    *
    * @return string
    */
    public function getPath()
    {
    return $this->archivo;
    }
    
    
}
