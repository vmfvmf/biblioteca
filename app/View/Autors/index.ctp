<?php
$this->extend('/Common/view');
$this->set("title_for_layout", "Autores");  
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> AUTORES </b>');
$this->start('sidebar');
?>
<li><?=$this->Html->link('Novo Autor',array('controller' => 'Autors', 'action' => 'add')); ?></li>
<?php $this->end(); ?>

<div id="main_div" >
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('autor','AUTOR');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<? foreach($autors as $autor){  ?>
        <tr>
               <td><?=$autor['Autor']['autor']; ?></td>
               
               <td>
                    <?=$this->Html->link('Editar',array('controller' => 'Autors', 'action' => 'edit',$autor['Autor']['id'])); ?>
                  |  <?=$this->Html->link('Excluir',array('controller' => 'Autors', 'action' => 'delete',$autor['Autor']['id']), null, "Deseja excluir este autor?"); ?>
                 

               </td> 
        </tr>
<?  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>