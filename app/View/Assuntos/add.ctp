<h1>Novo Assunto</h1>
<?php  

        echo    $this->Form->create('Assunto',array( 'action' => 'add')),
                       $this->Form->input('assunto'),
            $this->Form->end('cadastrar');
?>
