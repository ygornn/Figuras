    <?php
        require_once('../header.php');
        require_once('../classes/triangulo.class.php');
        require_once('../classes/quadro.class.php');
        $quadro = new Quadro(1, '');
        $triangulo = new Triangulo('',1,1,1,'x','x', 1);
        
        $id = isset($_GET['id'])?$_GET['id']:0;
        if ($id > 0){
            $dados = $triangulo->listar(1,$id);
            $qeditando = new Triangulo($dados[0]['id'],$dados[0]['lado1'], $dados[0]['lado2'], $dados[0]['lado3'],$dados[0]['cor'],$dados[0]['un'], $dados[0]['quadro']);
        }
    ?>
    <style>
        .desenho{
           /* border:1px solid black;*/
            display: inline-block;
        }
    </style>
    <div class="row" style="padding-top:40px">
    <h1>Cadastro de Triângulo</h1>
    <form action="acaotriangulo.php" method="post">
    <label for="id">Id:</label>
            <input readonly type="text" name='id' id='id' value='<?php echo isset($qeditando)?$qeditando->getId():0 ?>'>
            <label for="lado1">Lado 1 (O maior lado):</label>
            <input type="text" name='lado1' id='lado1' value='<?php if(isset($qeditando)) echo $qeditando->getLado1(); ?>'>
            <label for="lado2"> Lado 2:</label>
            <input type="text" name='lado2' id='lado2' value='<?php if(isset($qeditando)) echo $qeditando->getLado2(); ?>'>
            <label for="lado3"> Lado 3:</label>
            <input type="text" name='lado3' id='lado3' value='<?php if(isset($qeditando)) echo $qeditando->getLado3(); ?>'>
            <label for="un">UN:</label>
            <select name='un' id='un'>
                <option value=''>Selecione</option>
                <option value='cm' <?php  if(isset($qeditando)) if ($qeditando->getUn() == 'cm') echo 'selected'; ?> >Centímetros</option>
                <option value='px' <?php  if(isset($qeditando)) if ($qeditando->getUn() == 'px') echo 'selected'; ?>  >Pixel</option>
                <option value='%' <?php  if(isset($qeditando)) if ($qeditando->getUn() == '%') echo 'selected'; ?> >Porcentagem</option>
                <option value='vh' <?php  if(isset($qeditando)) if ($qeditando->getUn() == 'vh') echo 'selected'; ?> >View Port Height</option>
                <option value='vw' <?php  if(isset($qeditando)) if ($qeditando->getUn() == 'vw') echo 'selected'; ?> >View Port Width</option>
            </select>
            <label for="cor">Cor:</label>
            <input type="color" name='cor' id='cor' value='<?php  if($qeditando) echo $qeditando->getCor(); ?>'>
            <label for="quadro">Selecione o quadro:</label>
                <select name="quadro" id="quadro">
                    <?php 
                        foreach($quadro->listar() as $value){
                           $q = new Quadro($value['id'], $value['nome'], $circulo);
                           if(isset($qeditando) and $qeditando->getQuadro() == $q->getId()){
                                echo "<option value='{$q->getId()}' selected>{$q->getNome()}</option>";
                           }else{
                                echo "<option value='{$q->getId()}'>{$q->getNome()}</option>";
                           }
                        }
                    ?>
                </select>
            <button type="submit" value='salvar' name='acao' id='acao'>Salvar</button>
            <?php  if(isset($qeditando)){ ?>
                <button type="submit" value='excluir' name='acao' id='acao'>Excluir</button>
            <?php } ?>
    </form>
    <hr>
    <div style='height:70vw'>
    <?php
        
        $lista = $triangulo->listar();
        foreach($lista as $item){
            $q = new Triangulo($item['id'],$item['lado1'], $item['lado2'], $item['lado3'],$item['cor'],$item['un'],$item['quadro']);
            echo '<a href="index.php?id='.$q->getId().'">';
            echo $q->desenhar();
            echo '</a>';
            echo '<br> Área: ' .  $q->calcularArea() . $q->getUn() . '<br>';
            echo 'Perímetro: ' . $q->calcularPerimetro() . $q->getUn() . ' <br>';
        }
    ?>

    </div>
    </div>
</body>
</html>