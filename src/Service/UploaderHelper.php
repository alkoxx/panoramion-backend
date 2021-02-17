<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Sluggable\Util\Urlizer;

class UploaderHelper
{
    const MARKER_IMAGE_FOLDER = 'images';

    private $uploadsPath;

    public function __construct(string $uploadsPath)
    {
        $this->uploadsPath = $uploadsPath;
    }

    public function getPrivatePath(): string 
    {
        return $this->uploadsPath . '/' . self::MARKER_IMAGE_FOLDER;
    }

    public function uploadImage(UploadedFile $uploadedFile): string
    {
        $destination = $this->uploadsPath . '/' . self::MARKER_IMAGE_FOLDER;
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();

        $uploadedFile->move($destination, $newFilename);

        return $newFilename;
    }

    public function readStream(string $path){

        $filesystem = $isPublic ? $this->filesystem : $this->privateFilesystem;
        $resource = $filesystem->readStream($path);
        if ($resource === false) {
            throw new \Exception(sprintf('Error opening stream for "%s"', $path));
        }
        return $resource;

    }

}