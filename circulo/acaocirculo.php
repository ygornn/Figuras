<?php
$id = isset($_POST['id'])?$_POST['id']:0;
$lado = isset($_POST['lado'])?$_POST['lado']:0;
$cor = isset($_POST['cor'])?$_POST['cor']:'';
$un = isset($_POST['un'])?$_POST['un']:'';
$quadro = isset($_POST['quadro'])?$_POST['quadro']:'';
$acao = isset($_POST['acao'])?$_POST['acao']:'';

require_once('../classes/circulo.class.php');
require_once('../classes/quadro.class.php');

if ($acao == 'salvar'){
    try{
        $quadrado = new Circulo($id,$lado,$cor,$un,$quadro);
        //$qua = new Quadro($quadro, 'X');
        if ($id > 0)
        $quadrado->editar();
        else
        $quadrado->inserir();
        //$qua->addForma($quadrado);
        header('location:index.php');   

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}else if($acao == 'excluir'){
    try{
        $quadrado = new Circulo($id,$lado, $cor,$un, $quadro);
        $quadrado->excluir();
        header('location:index.php');   

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}

?>