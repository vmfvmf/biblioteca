<h1>Editar Autor</h1>

<?php  
       echo    $this->Form->create(),
                       $this->Form->input('nome'),
               $this->Form->input('ra'),
                       $this->Form->end('salvar');
?>