<?php
$this->set("title_for_layout", 'Editar Editora');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' EDITORAS ',array('controller' => 'Editoras', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> EDITAR </b>');

       echo    $this->Form->create(),
                       $this->Form->input('editora'),
                       $this->Form->end('salvar');
?>