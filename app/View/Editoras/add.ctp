<?php
$this->set("title_for_layout", 'Nova Editora');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' EDITORAS ',array('controller' => 'Editoras', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');

        echo    $this->Form->create('Editora',array( 'action' => 'add')),
                       $this->Form->input('editora'),
            $this->Form->end('cadastrar');
?>
