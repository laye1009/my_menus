<?php
namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;

class UploaderHelper
{
    private $uploadPath;
    public function __construct($uploadpath)
    {
        $this->uploadPath = $uploadpath;
    }
    public function upload($slug,$file):string
    {
        $filename=pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
        $safename = $slug->slug($filename);
        $newsafename = $safename.'-'.uniqid().'.'.$file->guessExtension();
        $destination = $this->uploadPath;
        if($newsafename){
            $file->move($destination,$newsafename);
        }
        return $newsafename;
    }
}