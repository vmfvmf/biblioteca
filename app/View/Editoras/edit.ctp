<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('EDITORAS',array('controller' => 'Editoras', 'action' => 'index'))
        .' > <b>EDITAR</b>';
?>
<h1>Editar Editora</h1>

<?php  
       echo    $this->Form->create(),
                       $this->Form->input('editora'),
                       $this->Form->end('salvar');
?>