<?php
$this->set("title_for_layout", "Autors");  
$this->extend('/Common/view');
$this->start('sidebar');
?>
<li><?=$this->Html->link('Novo Autor',array('controller' => 'Autors', 'action' => 'add')); ?></li>
<?php $this->end(); ?>
<h1>Autores<h1>


<table>
    <tr>
            <td><b><?=$this->Paginator->sort('nome','AUTOR');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<? foreach($autors as $autor){  ?>
        <tr>
               <td><?=$autor['Autor']['nome']; ?></td>
               
               <td>
                    <?=$this->Html->link('Editar',array('controller' => 'Autors', 'action' => 'edit',$autor['Autor']['id'])); ?>
                  |  <?=$this->Html->link('Excluir',array('controller' => 'Autors', 'action' => 'delete',$autor['Autor']['id']), null, "Deseja excluir este autor?"); ?>
                 

               </td> 
        </tr>
<?  }  ?>
</table>
<br/>
<?//=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
<br/>
<br/>
