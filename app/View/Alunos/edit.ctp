<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('ALUNOS',array('controller' => 'Alunos', 'action' => 'index'))
        .' > <b>EDITAR</b>';
?>
<h1>Editar Autor</h1>

<?php  
       echo    $this->Form->create(),
                             $this->Form->input('nome', array('label' => 'Nome')),
                $this->Form->input('ra', array('label' => 'RA')),
                $this->Form->input('ano_serie', array('label' => 'Série')),
                       $this->Form->end('salvar');
?>