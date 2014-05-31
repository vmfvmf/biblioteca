<?php
$this->set("title_for_layout", "Títulos");  
$this->extend('/Common/view');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').'<b> TÍTULOS </b>');

$this->start('sidebar');
?>
<li><?=$this->Html->link('Novo Título',array('controller' => 'Titulos', 'action' => 'add')); ?></li>
<br><li><?=$this->Html->link('Novo Autor',array('controller' => 'Autors', 'action' => 'add')); ?></li>
<br><li><?=$this->Html->link('Novo Assunto',array('controller' => 'Assuntos', 'action' => 'add')); ?></li>
<br><li><?=$this->Html->link('Nova Classificação',array('controller' => 'Titulos', 'action' => 'add')); ?></li>
<br><li><?=$this->Html->link('Nova Localização',array('controller' => 'Localizacaos', 'action' => 'add')); ?></li>

<?php 
    $this->end(); 
?>
<div id="main_div">
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('titulo','TÍTULO');?></b></td> 
            <td><b>LOCALIZAÇÃO</b></td>
            <td><b>AUTORES</b></td>
            <td><b>CLASSIFICAÇÕES</b></td>
            <td><b>AÇÃO</b></td>
    </tr>
    
<?php foreach($titulos as $titulo){  ?>
        <tr>
               <td><?=$this->Html->link($titulo['Viewtitulosdetalhe']['titulo'],array('controller' => 'Titulos', 'action' => 'view',$titulo['Viewtitulosdetalhe']['id'])); ?></td>
               <td><?=$titulo['Viewtitulosdetalhe']['localizacao']; ?></td>
               <td><?php
                                $txt = "";
                                $autor = explode(',',$titulo['Viewtitulosdetalhe']['autores']);
                                foreach($autor as $a){
                                    $txt .= str_replace(array('"','{','}'), '',$a).'<br>';
                                }
                                echo $txt;
                           ?>
               </td>
               <td><?php
                                $txt = "";
                                $cla = explode(',',$titulo['Viewtitulosdetalhe']['classificacaos']);
                                foreach($cla as $a){
                                    $txt .= str_replace(array('"','{','}'), '',$a).'<br>';
                                }
                                echo $txt;
                           ?>
               </td>
               <td>
                <?= $this->Html->link($this->Html->image('edit.png'), 
                        array("controller"=>"Titulos", "action"=>"edit",$titulo['Viewtitulosdetalhe']['id']), 
                        array('escape' => false, 'title' => "Editar"));?>
                   
                  | <?= $this->Html->link($this->Html->image('trash.png'), 
                        array("controller"=>"Titulos", "action"=>"delete",$titulo['Viewtitulosdetalhe']['id']), 
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este titulo?");?> 
               </td> 
        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>