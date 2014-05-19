<?php
$this->set("title_for_layout", "Copias");  
$this->extend('/Common/view');
$this->start('title');
echo $this->Html->link('BIBLIOTECA','../')   .' > <b>LIVROS</b>';
$this->end();
$this->start('sidebar');
?>
<li><?=$this->Html->link('Novo Livro',array('controller' => 'Livros', 'action' => 'add')); ?></li>
<?php $this->end(); ?>
<h1>Livros<h1>

        <div id="main_div">
<table>
    <tr>
            <td><b><?=$this->Paginator->sort('titulo','TITULO');?></b></td> 
            <td><b>EDIÇÃO</b></td> 
            <td><b>ANO</b></td> 
            <td><b>EDITORA</b></td> 
            <td><b>LOCALIZAÇÃO</b></td>
            <td><b>IDIOMA</b></td>
            <td><b>AUTORES</b></td>
            <td><b>AÇÃO</b></td>
    </tr>
    
<? foreach($livros as $livro){  ?>
        <tr>
               <td><?=$this->Html->link($livro['Titulo']['titulo'],array('controller' => 'Livros', 'action' => 'view',$livro['Livro']['id'])); ?></td>
               <td><?=$livro['Livro']['edicao']; ?></td>
               <td><?=$livro['Livro']['ano']; ?></td>
               <td><?=$livro['Editora']['editora']; ?></td>
               <td><?=$livro['Titulo']['Localizacao']['nome']; ?></td>
               <td><?=$livro['Idioma']['nome']; ?></td>
               <td><?
                                $txt = "";
                                foreach($livro['Titulo']['Autor'] as $autor){
                                    $txt .= $autor['nome'].'<br>';
                                }
                                echo $txt; 
                           ?>
               </td>
               <td>
                    <?=$this->Html->link('Editar',array('controller' => 'Livros', 'action' => 'edit',$livro['Livro']['id'])); ?>
                  |  <?=$this->Html->link('Excluir',array('controller' => 'Livros', 'action' => 'delete',$livro['Livro']['id']), null, "Deseja excluir este livro?"); ?>
                 

               </td> 
        </tr>
<?  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>