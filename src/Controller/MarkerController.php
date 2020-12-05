<?php

namespace App\Controller;

use App\Service\UploaderHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarkerController
{
    /**
     * @Route("/markers/add-marker")
     */
    public function addMarker(Request $request, UploaderHelper $uploaderHelper){
        
        $uploadedFile = $request->files->get('image');

        $newFilename = $uploaderHelper->uploadImage($uploadedFile);

        //dd($uploadedFile);
        
        $resp = new Response($newFilename);
        //$resp->headers->set('Access-Control-Allow-Origin', '*');
        
        return $resp;
    }

}