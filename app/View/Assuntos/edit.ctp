<h1>Editar Assunto</h1>

<?php  
       echo    $this->Form->create(),
                       $this->Form->input('assunto'),
                       $this->Form->end('salvar');
?>