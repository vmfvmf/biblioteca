<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('CLASSIFICAÇÕES',array('controller' => 'Classificacaos', 'action' => 'index'))
        .' > <b>NOVO</b>';
?>
<h1>Nova Classificação</h1>
<?php  

        echo    $this->Form->create('Classificacao',array( 'action' => 'add')),
                       $this->Form->input('classificacao'),
            $this->Form->end('cadastrar');
?>
