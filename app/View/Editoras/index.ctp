<?php
$this->set("title_for_layout", "Editoras");  
$this->extend('/Common/view');
$this->start('title');
echo $this->Html->link('BIBLIOTECA','../')   .' > <b>EDITORAS</b>';
$this->end();
$this->start('sidebar');
?>
<li><?=$this->Html->link('Nova Editora',array('controller' => 'Editoras', 'action' => 'add')); ?></li>
<?php $this->end(); ?>
<h1>Editoras<h1>

        <div id="main_div">
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('editora','EDITORA');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<? foreach($editoras as $ed){  ?>
        <tr>
               <td> <?=$ed['Editora']['editora'];?> </td>
               
               <td>
                    <?=$this->Html->link('Editar',array('controller' => 'Editoras', 'action' => 'edit',$ed['Editora']['id'])); ?>
                  |  <?=$this->Html->link('Excluir',array('controller' => 'Editoras', 'action' => 'delete',$ed['Editora']['id']), null, "Deseja excluir esta Editora?"); ?>
                 

               </td> 
        </tr>
<?  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>