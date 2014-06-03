<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", 'Editar Autor');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' AUTORES ',array('controller' => 'Autors', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> EDITAR </b>');

echo    $this->Form->create(),
                       $this->Form->input('autor'),
                       $this->Form->end('salvar');
?>