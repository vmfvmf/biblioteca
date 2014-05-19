<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('CLASSIFICAÇÕES',array('controller' => 'Classificacaos', 'action' => 'index'))
        .' > <b>EDITAR</b>';
?>
<h1>Editar Classificação</h1>

<?php  
       echo    $this->Form->create(),
                       $this->Form->input('classificacao'),
                       $this->Form->end('salvar');
?>