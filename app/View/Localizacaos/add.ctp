<h1>Nova Localização</h1>
<?php   echo    $this->Form->create('Localizacao',array( 'action' => 'add')),
                $this->input( 
                    'nome'),
                $this->Form->end('cadastrar');
?>
