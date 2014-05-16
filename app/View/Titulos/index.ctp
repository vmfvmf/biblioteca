<?php
$this->set("title_for_layout", "Titulos");  
$this->extend('/Common/view');
$this->start('sidebar');
?>
<li><?=$this->Html->link('Novo Titulo',array('controller' => 'Titulos', 'action' => 'add')); ?></li>
<?php $this->end(); ?>
<h1>Titulos<h1>


<table>
    <tr>
            <td><b><?=$this->Paginator->sort('titulo','TITULO');?></b></td> 
            <td><b>LOCALIZAÇÃO</b></td>
            <td><b>AUTORES</b></td>
            <td><b>AÇÃO</b></td>
    </tr>
    
<? foreach($titulos as $titulo){  ?>
        <tr>
               <td><?=$this->Html->link($titulo['Titulo']['titulo'],array('controller' => 'Titulos', 'action' => 'view',$titulo['Titulo']['id'])); ?></td>
               <td><?=$titulo['Localizacao']['nome']; ?></td>
               <td><?
                                $txt = "";
                                foreach($titulo['Autor'] as $autor){
                                    $txt .= $autor['nome'].'<br>';
                                }
                                echo $txt;
                           ?>
               </td>
               <td>
                    <?=$this->Html->link('Editar',array('controller' => 'Titulos', 'action' => 'edit',$titulo['Titulo']['id'])); ?>
                  |  <?=$this->Html->link('Excluir',array('controller' => 'Titulos', 'action' => 'delete',$titulo['Titulo']['id']), null, "Deseja excluir essa escola?"); ?>
                 

               </td> 
        </tr>
<?  }  ?>
</table>
<br/>
<?//=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
<br/>
<br/>
