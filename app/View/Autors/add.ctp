<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('AUTORES',array('controller' => 'Autors', 'action' => 'index'))
        .' > <b>NOVO</b>';
?>
<h1>Novo Autor</h1>
<?php  

        echo    $this->Form->create('Autor',array( 'action' => 'add')),
                       $this->Form->input('nome'),
            $this->Form->end('cadastrar');
?>
