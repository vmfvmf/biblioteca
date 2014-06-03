<?php
$this->assign('menu-principal', $this->element('menu-principal'));
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
    
<?php foreach($emprestimos as $emp){  ?>
        <tr>
               <td><?=$this->Html->link($emp['Viewlte']['aluno'],array('controller' => 'Alunos', 'action' => 'view',$emp['Viewlte']['aluno_id'])); ?></td>
               <td><?=$this->Html->link($emp['Viewlte']['titulo'],array('controller' => 'Livros', 'action' => 'view',$emp['Viewlte']['livro_id'])); ?></td>
               <td><?=$this->Time->format($emp['Viewlte']['data_emprestimo'], '%d/%m/%Y'); ?></td>
               <td><?=($emp['Viewlte']['data_devolucao'] != null) ? 
                 $this->Time->format($emp['Viewlte']['data_devolucao'], '%d/%m/%Y'):
                    $emp['Viewlte']['data_devolucao']; ?></td>
               <td><?=$this->Time->format($emp['Viewlte']['prazo_devolucao'], '%d/%m/%Y'); ?></td>
               <td>
                   <?= $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Emprestimos', 'action' => 'edit',$emp['Viewlte']['id']),
                        array('escape' => false, 'title' => "Editar"));?>
                   
                  | <?= $this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Emprestimos', 'action' => 'delete',$emp['Viewlte']['id']),
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este esmpréstimo?");?> 
                <?php if(!$emp['Viewlte']['data_devolucao']){ 
                    echo " | ".
                        $this->Html->link($this->Html->image('recycle.png'), 
                        array('controller' => 'Emprestimos','action' => 'devolver',$emp['Viewlte']['id']),
                        array('escape' => false, 'title' => "Devolver"), "Registrar devolução?");
                    
                    $date1 = date_create($this->Time->format($emp['Viewlte']['prazo_devolucao'],"%Y/%m/%d"));
                    $date2 = new DateTime();
                    $date2->format("%Y/%m/%d");
                    $diff=date_diff($date1,$date2,false);
                    if($diff->days > 0 && $diff->invert>0) echo " | " .
                        $this->Html->link($this->Html->image('extend.png'), 
                        array('controller' => 'Emprestimos','action' => 'prorrogar',$emp['Viewlte']['id']),
                        array('escape' => false, 'title' => "Renovar"), "Deseja renovar este esmpréstimo?");
                }?> 

               </td> 
        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>
