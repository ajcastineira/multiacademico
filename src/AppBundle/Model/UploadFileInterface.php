<?php

namespace AppBundle\Model;

/**
 *
 * @author Rene Arias <renearias@arxis.la>
 */
interface UploadFileInterface {
    public function getTemp();
    public function setTemp($temp);
    public function getWebPath();
    public function setWebPath($webPath);
}
