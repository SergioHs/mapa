<?php
session_start();
require '../utils/functions.php';
if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'PUT'){

    require '../classes/File.class.php';
    require '../classes/Ocorrencia.class.php';
    require '../classes/OcorrenciaDAO.class.php';

    $file = new File($_FILES['arquivo']);
    if($file->upload()){
        $ocorrencia = new Ocorrencia();
        $ocorrencia->setProblema($_POST['problema']);
        $ocorrencia->setDescricao($_POST['descricao']);
        $ocorrencia->setEndereco($_POST['endereco']);
        $ocorrencia->setLatitude($_POST['latitude']);
        $ocorrencia->setLongitude($_POST['longitude']);
        $ocorrencia->setArquivo($file);
        $ocorrenciaDAO = new OcorrenciaDAO();
        $ocorrenciaDAO->insert($ocorrencia);
        $_SESSION['flash_success'] = 'Problema informado com sucesso!';
    } else {
        $_SESSION['flash_error'] = $file->error;
    }
} else {
    $_SESSION['flash_error'] = 'Método HTTP inválido.';
}
redirect('../index.php');

?>
