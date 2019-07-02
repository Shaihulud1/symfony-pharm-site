<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUpload
{
    private $saveImageDirectory;
    private $publicPathDirectory;
    
    public function __construct($saveImageDirectory, $publicPathDirectory)
    {
        $this->saveImageDirectory = $saveImageDirectory;
        $this->publicPathDirectory = $publicPathDirectory;
    }   

    public function upload(UploadedFile $file, $deleteFile = false)
    {
        $safeFilename = md5($file->getClientOriginalName().time());
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        try {
            $file->move(
                $this->saveImageDirectory,
                $newFilename
            );
            if($deleteFile){
                $this->deleteExistFile($deleteFile);
            }
        } catch (FileException $e) {
            //move error
        }
        return $newFilename;
    }
    
    public function deleteExistFile($deleteFile)
    {
        $filePath = $this->publicPathDirectory.'/'.$deleteFile;
        if(file_exists($filePath)){
            unlink($filePath);
        }
    }

}