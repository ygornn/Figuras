    <?php
        require_once('../header.php');
        require_once('../classes/quadro.class.php');
        require_once('../classes/circulo.class.php');
        require_once('../classes/triangulo.class.php');
        require_once('../classes/retangulo.class.php');
        require_once('../classes/quadrado.class.php');
        
        $quadro = new Quadro(1, 'X');
        $id = isset($_GET['id'])?$_GET['id']:0;
        if ($id > 0){
            $dados = $quadro->listar(1,$id);
            $qeditando = new Quadro($dados[0]['id'],$dados[0]['nome']);
        }
    ?>
    <div class="row" style="padding-top:40px">
        <h1>Criar quadro</h1>

        <form action="acaoquadro.php" method="post">
            <label for="id">ID:</label>
        <input type="text" name="id" id="id" readonly value="<?php echo isset($qeditando)?$qeditando->getId():0;?>">
        <label for="nome">Nome do quadro:</label>
        <input type="text" name="nome" id="nome" value='<?php if(isset($qeditando)) echo $qeditando->getNome(); ?>'>
        <button type='submit' id="acao" name="acao" value="salvar">Salvar</button>
        <?php  if(isset($qeditando)){ ?>
                <button type="submit" value='excluir' name='acao' id='acao'>Excluir</button>
            <?php } ?>
    </form>
    <hr>
    <?php 
    function createFigs($figura, $q, $tipo){
        foreach($figura as $key => $value){
            if($tipo == 'Triangulo'){
                $f = new Triangulo($figura[$key]['id'], $figura[$key]['lado1'], $figura[$key]['lado2'], $figura[$key]['lado3'], $figura[$key]['cor'], 
                $figura[$key]['un'], $figura[$key]['quadro']);
                $q->addForma($f);
            }
            elseif($tipo == 'Circulo'){
                $f = new Circulo($figura[$key]['id'], $figura[$key]['lado'], $figura[$key]['cor'], $figura[$key]['un'], $figura[$key]['quadro']);
                $q->addForma($f);
            }elseif($tipo == 'Retangulo'){
                $f = new Retangulo($figura[$key]['id'], $figura[$key]['lado'], $figura[$key]['lado2'], $figura[$key]['cor'], $figura[$key]['un'], $figura[$key]['quadro']);
                $q->addForma($f);
            }else{
                $f = new Quadrado($figura[$key]['id'], $figura[$key]['lado'], $figura[$key]['cor'], $figura[$key]['un'], $figura[$key]['quadro']);
                $q->addForma($f);
            }

            }
        }

        foreach(Quadro::listar() as $key => $value){
            $q = new Quadro($value['id'], $value['nome']);
            $circulo = Circulo::listar(3, $q->getId());
            $triangulo = Triangulo::listar(3, $q->getId());
            $retangulo = Retangulo::listar(3, $q->getId());
            $quadrado = Quadrado::listar(3, $q->getId());
            createFigs($circulo, $q, 'Circulo');
            createFigs($triangulo, $q, 'Triangulo');
            createFigs($retangulo, $q, 'Retangulo');
            createFigs($quadrado, $q, 'Quadrado');
            echo "<div class='row'><p>{$q->getId()}° Quadro - {$q->getNome()}</p>";
            echo "{$q->listarFormas()}</div>";
            echo "<div class='row'><a href='index.php?id={$q->getId()}'>Editar</a></div>";
        }
    ?>
        </tr>
    </table>    
</div>
</body>
</html>