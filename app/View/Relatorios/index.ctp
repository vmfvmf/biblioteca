<?php
$this->assign('menu-principal', $this->element('menu-principal'));
    echo $this->Html->script('jquery', false);
    echo $this->Html->script('jquery-ui', false);
    echo $this->Html->css('jquery-ui', null, array('inline' => false));
?>
<h1>Relatórios</h1>
<div id="main_div">
    <div id="accordion">
        <h3 class="divh3">Alunos</h3>
        <div>
            <?php echo $this->Html->link('/Titulo',
                    array('controller' => 'Relatorios', 'action' => 'alunos'));?>
        </div>
        <h3 class="divh3">Titulos</h3>
        <div><p>dfh</p></div>
        <h3 class="divh3">Série</h3>
        <div><p>sadf</p></div>
    </div>
</div>
    <?php
    $this->Html->scriptStart(array('inline' => false));
    
    echo '$(function() {
        $( "#accordion" ).accordion();
    });';
    $this->Html->scriptEnd();
    echo $this->Js->writeBuffer();
    ?>

