<?php
$this->set("title_for_layout", 'Editar Assunto');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' ASSUNTOS ',array('controller' => 'Assuntos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> EDITAR </b>');

echo    $this->Form->create(),
                       $this->Form->input('assunto'),
                       $this->Form->end('salvar');
?>