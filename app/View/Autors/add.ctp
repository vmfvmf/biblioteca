<h1>Novo Autor</h1>
<?php  

        echo    $this->Form->create('Autor',array( 'action' => 'add')),
                       $this->Form->input('nome'),
            $this->Form->end('cadastrar');
?>
