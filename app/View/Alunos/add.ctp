<h1>Novo Aluno</h1>
<?php  

        echo    $this->Form->create('Aluno',array( 'action' => 'add')),
                       $this->Form->input('nome'),
                $this->Form->input('ra', array('label' => 'RA')),
            $this->Form->end('cadastrar');
?>
