<?php
$id = isset($_POST['id'])?$_POST['id']:0;
$lado = isset($_POST['lado'])?$_POST['lado']:0;
$lado2 = isset($_POST['lado2'])?$_POST['lado2']:0;
$cor = isset($_POST['cor'])?$_POST['cor']:'';
$un = isset($_POST['un'])?$_POST['un']:'';
$quadro = isset($_POST['quadro'])?$_POST['quadro']:'';
$acao = isset($_POST['acao'])?$_POST['acao']:'';
if ($acao == 'salvar'){
    try{
        require_once('../classes/retangulo.class.php');
        $retangulo = new Retangulo($id,$lado,$lado2,$cor,$un, $quadro);
        if ($id > 0)
            $retangulo->editar();
        else
            $retangulo->inserir();
        header('location:index.php'); 
        var_dump($_POST);  

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}else if($acao == 'excluir'){
    try{
        require_once('../classes/retangulo.class.php');
        $retangulo = new Retangulo($id,$lado,$lado2,$cor,$un, $quadro);
        $retangulo->excluir();
        header('location:index.php');   

    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
}
?>  