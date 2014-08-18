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
        <li><?=$this->Html->link('Buscar Aluno',array('controller' => 'Alunos', 'action' => 'index')); ?></li>
        <br/>
        <li><?=$this->Html->link('Todos Alunos',array('controller' => 'Alunos', 'action' => 'todos')); ?></li>
        <br/>
        <li><?=$this->Html->link('Ultimos Empréstimos',array('controller' => 'Emprestimos', 'action' => 'resultado/ra/'.$aluno['Viewaluno']['ra'])); ?></li>
    </ul>
<?php $this->end(); ?>

<h2><?=$aluno['Viewaluno']['nome'];?></h2>
<br/><b>RA</b> <?=$aluno['Viewaluno']['ra'];?>
<br/>
<br/>
<h3>ENDEREÇO</h3>
<?=$aluno['Viewaluno']['logradouro'].', '.$aluno['Viewaluno']['numero'].' - '.$aluno['Viewaluno']['bairro'].
                '<br/>'.$aluno['Viewaluno']['cidade'].'<br/>CEP.'.$aluno['Viewaluno']['cep'];?>
<br/>
<br/>
<h3>CONTATO</h3>
<a href="mailto:<?=$aluno['Viewaluno']['email'];?>?subject=Contato Biblioteca"><?=$aluno['Viewaluno']['email'];?></a>
<br/>

