<?php

namespace Multiservices\PayPayBundle\Bancos\Pichincha;

//use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class ListadoXLS{
    
    public $path;
    
    /**
     * Assert\File(maxSize="6000000",
                   mimeTypes = {"application/vnd.ms-excel","text/csv","text/csv-schema"},
                   mimeTypesMessage = "Por favor suba un XLS valido")
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    private $temp;
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        /*if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }*/
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
    
    
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    
    public function getWebPath()
    {
        return null === $this->path
            //? null
            ? $this->getUploadDir().'/factura.xml'
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'ComprobantesElectronicos/Generados';
    }
    
    
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            //$filename = sha1(uniqid(mt_rand(), true));
            //$this->path = $filename.'.'.$this->getFile()->guessExtension();
            $filename = $this->getFile()->getClientOriginalName();
            $this->path = $filename;
            
        }
    }

    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }
    

    
    
}