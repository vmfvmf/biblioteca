<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('ASSUNTOS',array('controller' => 'Assuntos', 'action' => 'index'))
        .' > <b>EDITAR</b>';
?>
<h1>Editar Assunto</h1>

<?php  
       echo    $this->Form->create(),
                       $this->Form->input('assunto'),
                       $this->Form->end('salvar');
?>