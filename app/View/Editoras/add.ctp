<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('EDITORAS',array('controller' => 'Editoras', 'action' => 'index'))
        .' > <b>NOVO</b>';
?>
<h1>Nova Editora</h1>
<?php  

        echo    $this->Form->create('Editora',array( 'action' => 'add')),
                       $this->Form->input('editora'),
            $this->Form->end('cadastrar');
?>
