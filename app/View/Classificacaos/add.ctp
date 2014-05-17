<h1>Novo Classificacao</h1>
<?php  

        echo    $this->Form->create('Classificacao',array( 'action' => 'add')),
                       $this->Form->input('classificacao'),
            $this->Form->end('cadastrar');
?>
