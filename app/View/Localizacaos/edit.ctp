<?php
$this->set("title_for_layout", 'Novo Empréstimo');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' LOCALIZAÇÕES ',array('controller' => 'Localizacaos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> EDITAR </b>');

echo    $this->Form->create('Localizacao',array( 'action' => 'edit')),
                $this->Form->input('localizacao'),
                $this->Form->end('salvar');
?>
