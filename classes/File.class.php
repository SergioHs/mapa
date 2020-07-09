<?php
class File {

    const PATH = 'files';
    const MAX_SIZE = 1028000;
    static $validExt = ['png','jpeg','jpg'];
    private $name;
    private $ext;
    private $size;
    private $file;
    private $uploadPath;
    public $error;

    public function __construct(Array $fileinput)
    {
        $this->file = $fileinput;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }
    public function setExt($ext)
    {
        $this->ext = $ext;
    }

    public function getExt()
    {
        return $this->ext;
    }

    private function buildName()
    {
        $this->name = md5(microtime());
        return $this->name;
    }

    private function validateExt()
    {
        $finfo = new Finfo(FILEINFO_MIME_TYPE);
        $ext = explode('/',$finfo->file($this->file['tmp_name']))[1];

        if(in_array($ext,self::$validExt))
            return true;

        return false;
    }

    private function validateSize()
    {
        if($this->file['size'] < self::MAX_SIZE)
            return true;

        return false;
    }

    private function mkdir()
    {

    }

    private function buildUploadPath()
    {
         $this->uploadPath = $_SERVER['DOCUMENT_ROOT'].'/'.self::PATH.'/'.$this->buildName();
         return $this->uploadPath;
    }

    public function upload()
    {
        if(!$this->validateSize()){
            $this->error = "O arquivo excedeu o limite de ".self::MAX_SIZE.'kb';
            return false;
        }

        if(!$this->validateExt()){
            $this->error = "Tipo de arquivo inválido";
            return false;
        }

        if(!move_uploaded_file($this->file['tmp_name'], $this->buildUploadPath())){
            $this->error = "Erro ao armazenar arquivo";
            return false;
        }

        return true;
    }


}





?>
