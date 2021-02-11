<?php

namespace App\Controller;

use App\Service\UploaderHelper;
use App\Entity\FileObject;
use App\Entity\Marker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateFileObjectAction
{
    public function __invoke(Request $request, Marker $data, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager)
    {
        
        $uploadedFile = $request->files->get('image');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required.');
        }
        $fileName = $uploaderHelper->uploadImage($uploadedFile);

        $fileObject = new FileObject();
        $fileObject->setFileName($fileName);
        $fileObject->setMarker($data);

        $entityManager->persist($fileObject);
        //$entityManager->flush();

        return $data;
        
    }    

}