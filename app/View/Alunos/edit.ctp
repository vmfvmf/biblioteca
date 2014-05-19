<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('ALUNOS',array('controller' => 'Alunos', 'action' => 'index'))
        .' > <b>EDITAR</b>';
?>
<h1>Editar Autor</h1>

<?php  
       echo    $this->Form->create(),
                       $this->Form->input('nome'),
               $this->Form->input('ra'),
                       $this->Form->end('salvar');
?>