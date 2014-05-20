<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('ALUNOS',array('controller' => 'Alunos', 'action' => 'index'))
        .' > <b>NOVO</b>';
?>
<h1>Novo Aluno</h1>
<?php  

        echo    $this->Form->create('Aluno',array( 'action' => 'add')),
                       $this->Form->input('nome', array('label' => 'Nome')),
                $this->Form->input('ra', array('label' => 'RA')),
                $this->Form->input('ano_serie', array('label' => 'Série')),
            $this->Form->end('cadastrar');
?>
