<h1>Nova Editora</h1>
<?php  

        echo    $this->Form->create('Editora',array( 'action' => 'add')),
                       $this->Form->input('editora'),
            $this->Form->end('cadastrar');
?>
