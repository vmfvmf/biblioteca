<?php
$this->set("title_for_layout", "Detalhes Aluno");  
$this->assign('menu-principal', $this->element('menu-principal'));
$this->extend('/Common/view');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' ALUNOS ',array('controller' => 'Alunos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> DETALHES </b>');

$this->start('sidebar');
?>
    <ul>
    </ul>
<?php $this->end(); ?>

<h2><?=$aluno['Aluno']['nome'];?></h2>
<br/><b>RA</b> <?=$aluno['Aluno']['ra'];?>

<br/>

