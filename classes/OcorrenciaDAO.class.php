<?php

require 'Connection.class.php';

class OcorrenciaDAO extends Connection {

    public function __construct()
    {
    }

    public function getById($id)
    {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM ocorrencias WHERE id = :id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
        } catch(PDOException $e){
            echo "Erro ".$e->getMessage();
        }
    }

    public function getAllIds()
    {
        try {
            $stmt = $this->connect()->query("SELECT id FROM ocorrencias",PDO::FETCH_OBJ);
            $stmt->execute();
            return $stmt;

        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    public function getAll()
    {
        try {
            $stmt = $this->connect()->query("SELECT * FROM ocorrencias",PDO::FETCH_OBJ);
            $stmt->execute();
            return $stmt;

        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    public function insert(Ocorrencia $ocorrencia)
    {
        try {
            $stmt = $this->connect()->prepare("INSERT INTO ocorrencias(problema,descricao,endereco,latitude,longitude,arquivo) VALUES (:problema,:descricao,:endereco,:latitude,:longitude,:arquivo)");
            $problema = $ocorrencia->getProblema();
            $descricao = $ocorrencia->getDescricao();
            $endereco = $ocorrencia->getEndereco();
            $latitude = $ocorrencia->getLatitude();
            $longitude = $ocorrencia->getLongitude();
            $arquivo = $ocorrencia->getArquivo();
            $stmt->bindParam(':problema',$problema);
            $stmt->bindParam(':descricao',$descricao);
            $stmt->bindParam(':endereco',$endereco);
            $stmt->bindParam(':latitude',$latitude);
            $stmt->bindParam(':longitude',$longitude);
            $stmt->bindParam(':arquivo',$arquivo);
            $stmt->execute();
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function delete(Ocorrencia $ocorrencia)
    {

    }

    public function update(Ocorrencia $ocorrencia)
    {
        try {
            $stmt = $this->connect()->prepare("UPDATE ocorrencias SET problema = :problema, latitude = :latitude, endereco = :endereco, longitude = :longitude
                                              WHERE id = $ocorrencia->getId()");
            $problema = $ocorrencia->getProblema();
            $latitude = $ocorrencia->getLatitude();
            $longitude = $ocorrencia->getLongitude();
            $endereco = $ocorrencia->getEndereco();
            $stmt->bindParam(':problema',$problema);
            $stmt->bindParam(':latitude',$latitude);
            $stmt->bindParam(':endereco',$endereco);
            $stmt->bindParam(':longitude',$longitude);
            $stmt->execute();
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

?>
