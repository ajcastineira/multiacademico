<?php

namespace AppBundle\Model;

/**
 *
 * @author Rene Arias <renearias@arxis.la>
 */
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploadFileInterface
{
    public function getPath();
    public function setPath($path);
    public function getFile();
    public function setFile(UploadedFile $file = null);
    public function getTemp();
    public function setTemp($temp);
    public function getWebPath();
    public function setWebPath($webPath);
    public function getUploadRootDir();
    public function getUploadDir();
}
