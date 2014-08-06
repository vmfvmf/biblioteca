<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", 'Nova Editora');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' IDIOMAS ',array('controller' => 'Idiomas', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');

        echo    $this->Form->create('Idioma',array( 'action' => 'add')),
                       $this->Form->input('idioma'),
            $this->Form->end('cadastrar');
?>
