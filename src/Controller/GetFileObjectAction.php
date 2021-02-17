<?php

namespace App\Controller;

use App\Service\UploaderHelper;
use App\Entity\Marker;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class GetFileObjectAction
{
    public function __invoke(Marker $data, UploaderHelper $uploaderHelper)
    {
        $fileObject = $data->getFileObjects()[0];
        $fileName = $fileObject->getFileName();

        return new BinaryFileResponse($uploaderHelper->getPrivatePath(). '/' .$fileName);        
    }    

}