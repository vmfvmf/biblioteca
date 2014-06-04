<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Detalhes Empréstimo");  
$this->set("title_for_layout", 'Novo Empréstimo');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' EMPRÉSTIMOS ',array('controller' => 'Emprestimos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> DETALHES </b>');

$this->extend('/Common/view');
$this->start('sidebar');
?>
    <ul>
    </ul>
<?php $this->end(); ?>
<h2>Livro</h2>
<h3> <?=$this->Html->link($emprestimo['Viewlte']['titulo'],
        array('controller'=>'Livros','action'=>'view',$emprestimo['Viewlte']['livro_id']));?></h3>


<h2>Aluno</h2>
<h3><?=$this->Html->link($emprestimo['Viewlte']['aluno'],
        array('controller'=>'Alunos','action'=>'view',$emprestimo['Viewlte']['aluno_id']));?></h3> 

<br/>

