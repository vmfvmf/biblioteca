<?php
$this->set("title_for_layout", 'Editar Idioma');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' IDIOMAS ',array('controller' => 'Idiomas', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> EDITAR </b>');

       echo    $this->Form->create(),
                       $this->Form->input('idioma'),
                       $this->Form->end('salvar');
?>