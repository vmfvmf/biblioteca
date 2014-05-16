<?php
$this->set("title_for_layout", "Emprestimos");  
$this->extend('/Common/view');
$this->start('sidebar');
?>
<li><?=$this->Html->link('Registrar Empréstimo',array('controller' => 'Emprestimos', 'action' => 'add')); ?></li>
<?php $this->end(); ?>
<h1>Emprestimos<h1>


<table>
    <tr>
            <td><b>ALUNO</b></td> 
            <td><b>LIVRO</b></td> 
            <td><b>DATA EMPRESTIMO</b></td> 
            <td><b>DATA DEVOLUÇÃO</b></td>
            <td><b>AÇÕES</b></td>
    </tr>
    
<? foreach($emprestimos as $emp){  ?>
        <tr>
               <td><?=$emp['Aluno']['nome']; ?></td>
               <td><?=$emp['Livro']['Titulo']['titulo']; ?></td>
               <td><?=$this->Time->format($emp['Emprestimo']['data_emprestimo'], '%d/%m/%Y - %H:%M'); ?></td>
               <td><?=($emp['Emprestimo']['data_devolucao'] != null) ? 
                 $this->Time->format($emp['Emprestimo']['data_devolucao'], '%d/%m/%Y - %H:%M'):
                    $emp['Emprestimo']['data_devolucao']; ?></td>
               <td>
                    <?=$this->Html->link('Editar',array('controller' => 'Emprestimos', 'action' => 'edit',$emp['Emprestimo']['id'])); ?>
                  |  <?=$this->Html->link('Excluir',array('controller' => 'Emprestimos', 'action' => 'delete',$emp['Emprestimo']['id']), null, "Deseja excluir este emprestimo?"); ?>
               <? if(!$emp['Emprestimo']['data_devolucao']) echo ' | '. $this->Html->link('Devolver',array('controller' => 'Emprestimos', 'action' => 'devolver',$emp['Emprestimo']['id']), null, "Registrar devolução?"); ?>
                  |  <?=$this->Html->link('Detalhes',array('controller' => 'Emprestimos', 'action' => 'view',$emp['Emprestimo']['id'])); ?>
                 

               </td> 
        </tr>
<?  }  ?>
</table>
<br/>
<?//=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
<br/>
<br/>

