<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('AUTORES',array('controller' => 'Autors', 'action' => 'index'))
        .' > <b>EDITAR</b>';
?>
<h1>Editar Autor</h1>

<?php  
       echo    $this->Form->create(),
                       $this->Form->input('nome'),
                       $this->Form->end('salvar');
?>