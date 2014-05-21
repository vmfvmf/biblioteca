<?php
$this->set("title_for_layout", "Localizações");  
$this->extend('/Common/view');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> LOCALIZAÇÕES </b>');

$this->start('sidebar');
?>
<li><?=$this->Html->link('Nova Localização',array('controller' => 'Localizacaos', 'action' => 'add')); ?></li>
<?php $this->end(); ?>

<div id="main_div" >
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('localizacao','Localizacao');?></b></td> 
            <td><b>AÇÃO</b></td>
    </tr>
    
<? foreach($localizacao as $lo){  ?>
        <tr>
               <td><?=$lo['Localizacao']['localizacao']; ?></td>
               
               <td>
                    <?=$this->Html->link('Editar',array('controller' => 'Localizacaos', 'action' => 'edit',$lo['Localizacao']['id'])); ?>
                  |  <?=$this->Html->link('Excluir',array('controller' => 'Localizacaos', 'action' => 'delete',$lo['Localizacao']['id']), null, "Deseja excluir esta Localização?"); ?>
                 

               </td> 
        </tr>
<?  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>