<?php
require_once('../classes/forma.class.php');

class Triangulo extends Forma{
    private $lado2;
    private $lado3;


    public function __construct($id, $lado1, $lado2, $lado3, $cor, $un, $qua){
        parent::__construct($id, $lado1, $cor, $un, $qua);
        $this->setLado2($lado2);
        $this->setLado3($lado3);
    }

    public function setLado2($lado2){
        if ($lado2 > 0){
            $this->lado2 = $lado2;
        }else
            throw new Exception('Valor para o lado 2 inválido.');
    }

    public function setLado3($lado3){
        if ($lado3 > 0){
            $this->lado3 = $lado3;
        }else
            throw new Exception('Valor para o lado 3 inválido.');
    }

    public function setLado1($lado1){
        if ($lado1 > 0){
            parent::setLado($lado1);
        }else
            throw new Exception('Valor para o lado 1 inválido.');
    }

    public function getLado1(){
        return parent::getLado();
    }

    public function getLado2(){
        return $this->lado2;
    }

    public function getLado3(){
        return $this->lado3;
    }

    public function inserir(){
        $sql = 'INSERT INTO triangulo (lado1, lado2, lado3, cor, un, quadro)
                     VALUES (:lado1, :lado2, :lado3, :cor, :un, :quadro)';
        $params = array(':lado1'=>$this->getLado1(),
                        ':lado2'=>$this->getLado2(),
                        ':lado3'=>$this->getLado3(),
                        ':cor'=>$this->getCor() ,
                        ':un'=>$this->getUn(),
                        ':quadro'=>$this->getQuadro());
       
       return Database::executar($sql, $params);
    }

    public function excluir(){
        $sql = 'DELETE FROM triangulo
                 WHERE id = :id';         
        $params = array(':id'=>$this->getId());         
        return Database::executar($sql, $params);
    }

    public function editar(){
        $sql = 'UPDATE triangulo
                   SET lado1 = :lado1,
                       lado2 = :lado2,
                       lado3 = :lado3,
                       cor  = :cor,
                       un   = :un,
                       quadro = :quadro
                 WHERE   id = :id';
        $params = array(':id'=>$this->getId(),
                        ':lado1'=> $this->getLado1(),
                        ':lado2'=> $this->getLado2(),
                        ':lado3'=> $this->getLado3(),
                        ':cor'=> $this->getCor(),
                        ':un'=> $this->getUn(),
                        ':quadro' =>$this->getQuadro());
       return Database::executar($sql, $params);
       
    }
 
    public static function listar($tipo = 0, $info = ''){
       $sql = 'SELECT * FROM triangulo';
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

    
    public function verificaTipo(){
        if(pow($this->getLado1(), 2) == pow($this->getLado2(), 2) + pow($this->getLado3(), 2)){
            return 'Retângulo';
        }else if($this->getLado1() == $this->getLado2() && $this->getLado2() == $this->getLado3() && $this->getLado1() == $this->getLado3()){
            return 'Equilátero';
        }else{
            return 'Escaleno';
        }
        
    }

    public function desenhar(){
       $tipo = $this->verificaTipo();
       //echo $tipo;
       $desenho = "";
       switch($tipo){
           case 'Retângulo':
            $desenho .="<div class='desenho'
                        style='  width: 0; 
                        height: 0; 
                        border-left: {$this->getLado1()}{$this->getUn()} solid transparent;
                        border-bottom: {$this->getLado3()}{$this->getUn()} solid {$this->getCor()};'></div>";
            break;
            case 'Equilátero':
                $desenho .="<div class='desenho' 
                style='  width: 0; 
                height: 0; 
                border-left: {$this->getLado1()}{$this->getUn()} solid transparent;
                border-right: {$this->getLado2()}{$this->getUn()} solid transparent;
                border-bottom: {$this->getLado3()}{$this->getUn()} solid {$this->getCor()};'></div>";
            break;
            case 'Escaleno':
                $desenho .="<div class='desenho' 
                style='  width: 0; 
                height: 0; 
                border-left: {$this->getLado1()}{$this->getUn()} solid transparent;
                border-right: {$this->getLado2()}{$this->getUn()} solid transparent;
                border-bottom: {$this->getLado3()}{$this->getUn()} solid {$this->getCor()};'></div>";
            break;


       }
       echo $desenho;
    }

    // public function retornaMaiorLado(){
    //     if($this->getLado1() >= $this->getLado2() && $this->getLado1() >= $this->getLado3()){
    //         return $this->getLado1();
    //     }else if($this->getLado2() >= $this->getLado1() && $this->getLado2() >= $this->getLado3()){
    //         return $this->getLado2();
    //     }else {return $this->getLado3();}
    // }

    public function calcularArea(){
        $tipo = $this->verificaTipo();
        $area = 0;
        switch($tipo){
            case $this->verificaTipo() == 'Retângulo': $area = $this->getLado1() * $this->getLado3() / 2; break;
            case $this->verificaTipo() == 'Equilátero' : $area = pow($this->getLado1(), 2) * sqrt(3) / 4; break;
            case $this->verificaTipo() == 'Escaleno' : 
            $p = $this->calcularPerimetro() /2;
            $area = sqrt(abs($p * 
            ($p - $this->getLado1()) * ($p - $this->getLado2()) *
            ($p - $this->getLado3()))); break;
        }
        return number_format($area, 2);
    }

    public function calcularPerimetro(){
       return $this->getLado1() + $this->getLado2() + $this->getLado3();
    }
}

?>