<?php

class Ocorrencia {

    private $problema;
    private $descricao;
    private $endereco;
    private $file;
    private $latitude;
    private $longitude;

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setProblema($problema)
    {
        $this->problema = $problema;
    }

    public function getProblema()
    {
        return $this->problema;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setArquivo(File $file)
    {
        $this->file = $file->getName();
    }

    public function getArquivo()
    {
        return $this->file;
    }
}


?>
