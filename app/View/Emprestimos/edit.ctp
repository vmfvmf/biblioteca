<h1>Editar Escola</h1>

<?php  
        echo    $this->Form->create('Escola',array( 'action' => 'edit')),
                       $this->Form->input('id',array('type'=>'hidden')),
                       $this->Form->input('nome'),
                       $this->Form->input('cie'),
                       $this->Form->input('cidade_id',array('options'=>$cidades,'empty' => 'Selecione a cidade')),
                       $this->Form->input('rua'),
                       $this->Form->input('numero'),
                       $this->Form->input('cep'),
                       $this->Form->input('bairro'),
                       $this->Form->input('universitario_id',array('options'=>$universitarios,'empty' => 'Selecione o universtário')),
                       $this->Form->end('salvar');
?>