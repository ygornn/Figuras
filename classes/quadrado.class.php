<?php
require_once ('../classes/forma.class.php');
require_once ('../classes/database.class.php');
    

class Quadrado extends Forma{
    /**
     * Atributos da classe
     */

     public function __construct($id, $lado, $cor, $un, $qua){
         parent::__construct($id, $lado, $cor, $un, $qua);
     }

     public function inserir(){
         $sql = 'INSERT INTO quadrado (lado, cor, un, quadro)
                      VALUES (:lado, :cor, :un, :quadro)';
         $params = array(':lado'=>$this->getLado(),
                         ':cor'=>$this->getCor() ,
                         ':un'=>$this->getUn(),
                         ':quadro'=>$this->getQuadro()
                        );
        
        return Database::executar($sql, $params);
     }

     public function excluir(){
         $sql = 'DELETE FROM quadrado 
                  WHERE id = :id';         
         $params = array(':id'=>$this->getId());         
         return Database::executar($sql, $params);
     }

     public function editar(){
         $sql = 'UPDATE quadrado
                    SET lado = :lado,
                        cor  = :cor,
                        un   = :un,
                        quadro = :quadro
                  WHERE   id = :id';
         $params = array(':id'=>$this->getId(),
                         ':lado'=> $this->getLado(),
                         ':cor'=> $this->getCor(),
                         ':un'=> $this->getUn(),
                         ':quadro'=>$this->getQuadro()
                        );
        return Database::executar($sql, $params);
        
     }
  
     public static function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM quadrado';
        switch($tipo){
            case 1: $sql .= ' WHERE id = :info'; break;
            case 2: $sql .= ' WHERE cor like :info';  break;
            case 3: $sql .= ' WHERE quadro = :info'; break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
     }

     public function desenhar(){
        $desenho = "<div class='desenho' 
                    style='width:{$this->getLado()}{$this->getUn()};
                     height:{$this->getLado()}{$this->getUn()};
                     background-color:{$this->getCor()}'></div>";
        return $desenho;
     }

     public function calcularArea(){
      return $this->getLado()*$this->getLado();
     }

     
     public function calcularPerimetro(){
        return $this->getLado() * 4;
     }
}

?>