<?php
require_once ('../classes/forma.class.php');
require_once ('../classes/database.class.php');
    

class Circulo extends Forma{

     public function __construct($id, $lado, $cor, $un, $qua){
         parent::__construct($id, $lado, $cor, $un, $qua);
     }

     public function inserir(){
         $sql = 'INSERT INTO circulo (lado, cor, un, quadro)
                      VALUES (:lado, :cor, :un, :quadro)';
         $params = array(':lado'=>$this->getLado(),
                         ':cor'=>$this->getCor() ,
                         ':un'=>$this->getUn(),
                         ':quadro'=>$this->getQuadro()
                        );
        
        return Database::executar($sql, $params);
     }

     public function excluir(){
         $sql = 'DELETE FROM circulo
                  WHERE id = :id';         
         $params = array(':id'=>$this->getId());         
         return Database::executar($sql, $params);
     }

     public function editar(){
         $sql = 'UPDATE circulo
                    SET lado = :lado,
                        cor  = :cor,
                        un   = :un, 
                        quadro = :quadro
                  WHERE   id = :id';
         $params = array(':id'=>$this->getId(),
                         ':lado'=> $this->getLado(),
                         ':cor'=> $this->getCor(),
                         ':un'=> $this->getUn(),
                         ':quadro' => $this->getQuadro()
                        );
        return Database::executar($sql, $params);
        
     }
  
     public static function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM circulo';
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
                    border-radius:50%;
                    background-color:{$this->getCor()}'></div>";
        return $desenho;
     }

     public function calcularArea(){
        return number_format(pow($this->getLado() , 2) * pi(), 2);
     }

     public function calcularPerimetro(){
        return number_format($this->getLado() * 2 * pi(), 2);
     }

}

?>