<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('ASSUNTOS',array('controller' => 'Assuntos', 'action' => 'index'))
        .' > <b>NOVO</b>';
?>
<h1>Novo Assunto</h1>
<?php  

        echo    $this->Form->create('Assunto',array( 'action' => 'add')),
                       $this->Form->input('assunto'),
            $this->Form->end('cadastrar');
?>
