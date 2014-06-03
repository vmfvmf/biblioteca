<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->extend('/Common/view');
$this->set("title_for_layout", "Classificações");  
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> CLASSIFICAÇÕES </b>');


$this->start('sidebar');
?>
<li><?=$this->Html->link('Nova Classificação',array('controller' => 'Classificacaos', 'action' => 'add')); ?></li>
<?php $this->end(); ?>

        <div id="main_div" >
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('classificacao','CLASSIFICAÇÃO');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<?php foreach($classificacao as $cas){  ?>
        <tr>
               <td><?=$cas['Classificacao']['classificacao']?></td>
               
               <td>
                   <?= $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Classificacaos', 'action' => 'edit',$cas['Classificacao']['id']),
                        array('escape' => false, 'title' => "Editar"));?>
                   
                  | <?= $this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Classificacaos', 'action' => 'delete',$cas['Classificacao']['id']),
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir esta classificação?");?> 
                 

               </td> 
        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>