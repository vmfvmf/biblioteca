<?php
$this->extend('/Common/view');
$this->set("title_for_layout", "Empréstimos");  
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> EMPRÉSTIMOS </b>');
$this->start('sidebar');
?>
<li><?=$this->Html->link('Registrar Empréstimo',array('controller' => 'Emprestimos', 'action' => 'add')); ?></li>
<?php $this->end(); ?>
<div id="main_div">
<table>
    <tr>
            <td><b>ALUNO</b></td> 
            <td><b>LIVRO</b></td> 
            <td><b>DATA EMPRÉSTIMO</b></td> 
            <td><b>DATA DEVOLUÇÃO</b></td>
            <td><b>PRAZO DEVOLUÇÃO</b></td>
            <td><b>AÇÕES</b></td>
    </tr>
    
<? foreach($emprestimos as $emp){  ?>
        <tr>
               <td><?=$emp['Viewlte']['aluno']; ?></td>
               <td><?=$emp['Viewlte']['titulo']; ?></td>
               <td><?=$this->Time->format($emp['Viewlte']['data_emprestimo'], '%d/%m/%Y'); ?></td>
               <td><?=($emp['Viewlte']['data_devolucao'] != null) ? 
                 $this->Time->format($emp['Viewlte']['data_devolucao'], '%d/%m/%Y'):
                    $emp['Viewlte']['data_devolucao']; ?></td>
               <td><?=$this->Time->format($emp['Viewlte']['prazo_devolucao'], '%d/%m/%Y'); ?></td>
               <td>
                    <?=$this->Html->link('Editar',array('controller' => 'Emprestimos', 'action' => 'edit',$emp['Viewlte']['id'])); ?>
                  |  <?=$this->Html->link('Excluir',array('controller' => 'Emprestimos', 'action' => 'delete',$emp['Viewlte']['id']), null, "Deseja excluir este emprestimo?"); ?>
               <? if(!$emp['Viewlte']['data_devolucao']) echo ' | '. $this->Html->link('Devolver',array('controller' => 'Emprestimos',
                        'action' => 'devolver',$emp['Viewlte']['id']), null, "Registrar devolução?"); ?>
                  <? if(!$emp['Viewlte']['data_devolucao']) echo ' | '. $this->Html->link('Prorrogar',array('controller' => 'Emprestimos',
                        'action' => 'prorrogar',$emp['Viewlte']['id']), null, "Registrar devolução?"); ?>
                  |  <?=$this->Html->link('Detalhes',array('controller' => 'Emprestimos', 'action' => 'view',$emp['Viewlte']['id'])); ?>
                 

               </td> 
        </tr>
<?  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>
