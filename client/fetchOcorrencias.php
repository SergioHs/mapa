<?php
require '../utils/functions.php';
require '../classes/OcorrenciaDAO.class.php';

$ocorrenciaDAO = new OcorrenciaDAO();
$ocorrencias = $ocorrenciaDAO->getAll();
$features = [];
$features['type'] = 'FeatureCollection';
$features['features'] = [];
$auxiliar = [];
while($ocorrencia = $ocorrencias->fetch(PDO::FETCH_OBJ)){
    $auxiliar['type'] = 'Feature';
    $auxiliar['geometry'] = [];
    $auxiliar['geometry']['type'] = 'Point';
    $auxiliar['geometry']['coordinates'] = [(float)$ocorrencia->longitude,(float)$ocorrencia->latitude];
    $auxiliar['properties'] = [];
    $auxiliar['properties']['name'] = $ocorrencia->problema;
    $auxiliar['properties']['description'] = $ocorrencia->descricao;
    $auxiliar['properties']['arquivo'] = $ocorrencia->arquivo;
    array_push($features['features'],$auxiliar);
}

echo json_encode($features);



?>
