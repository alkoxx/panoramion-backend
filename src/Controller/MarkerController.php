<?php

namespace App\Controller;

use App\Service\UploaderHelper;
use App\Entity\Marker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarkerController
{
    /**
     * @Route("/marker/add-marker", methods="POST")
     */
    public function addMarker(Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager){
        
        $uploadedFile = $request->files->get('image');
        $newFilename = $uploaderHelper->uploadImage($uploadedFile);

        $marker = new Marker();
        $marker->setLat($request->request->get('lat'));
        $marker->setLng($request->request->get('lng'));
        $marker->setDescription('test desc');
        $marker->setFilename($newFilename);

        $entityManager->persist($marker);
        $entityManager->flush();

        $resp = new Response($uploaderHelper->getPublicPath(UploaderHelper::MARKER_IMAGE_FOLDER . '/' . $newFilename));
        //$resp->headers->set('Access-Control-Allow-Origin', '*');

        return $resp;
    }

}