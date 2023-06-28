<?php
require_once("../classes/triangulo.class.php");
require_once("../classes/database.class.php");
class Quadro{
    private $id;
    private $nome;
    private $formas;

    public function __construct($pid, $pnome)
    {
        $this->setId($pid);
        $this->setNome($pnome);
        $this->formas = array();
    }

    public function setId($id): self{$this->id = $id; return $this;}
    public function setNome($nome): self{$this->nome = $nome; return $this;}
    public function getNome(){return $this->nome;}
    public function getFormas(){return $this->formas;}
    public function getId(){return $this->id;}
    public function addForma(Forma $forma){
        $this->formas[] = $forma;
    }

    public function listarFormas(){
        foreach($this->formas as $forma){
            echo $forma->desenhar();
        }
    }

    public function inserir(){
        $sql = 'INSERT INTO quadro (nome)
                     VALUES (:nome)';
        $params = array(':nome'=>$this->getNome());
       
       return Database::executar($sql, $params);
    }

    public function excluir(){
        $sql = 'DELETE FROM quadro 
                 WHERE id = :id';         
        $params = array(':id'=>$this->getId());         
        return Database::executar($sql, $params);
    }

    public function editar(){
        $sql = 'UPDATE quadro
                   SET nome = :nome
                 WHERE   id = :id';
        $params = array(':id'=>$this->getId(), ':nome'=>$this->getNome());
       return Database::executar($sql, $params);
       
    }
 
    public static function listar($tipo = 0, $info = ''){
       $sql = 'SELECT * FROM quadro';
       switch($tipo){
           case 1: $sql .= ' WHERE id = :info'; break;
           case 2: $sql .= ' WHERE nome like :info';  break;
       }           
       $params = array();
       if ($tipo > 0)
           $params = array(':info'=>$info);         
       return Database::listar($sql, $params);
    }
}