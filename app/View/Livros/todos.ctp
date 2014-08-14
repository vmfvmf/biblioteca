<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->extend('/Common/view');
$this->set("title_for_layout", "Livros");  
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' LIVROS ',array('controller' => 'Livros', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> TODOS </b>');

$this->start('sidebar');
?>
<li><?= $this->Session->read('Auth.User.role') === 'sadmin' ||
        $this->Session->read('Auth.User.role') === 'admin' ? $this->Html->link('Novo Livro',array('controller' => 'Livros', 'action' => 'add')) : ''; ?></li>
<br/>
<li><?=$this->Html->link('Buscar Livro',array('controller' => 'Livros', 'action' => 'index')); ?></li>
<?php $this->end(); ?>
        <div id="main_div">
<table>
    <tr>
        <td></td>
            <td><b><?=$this->Paginator->sort('titulo','TÍTULO');?></b></td> 
            <td><b>EDIÇÃO</b></td> 
            <td><b>ANO</b></td> 
            <td><b>EDITORA</b></td> 
            <td><b>LOCALIZAÇÃO</b></td>
            <td><b>IDIOMA</b></td>
            <td><b>AUTORES</b></td>
            <?= $this->Session->read('Auth.User.role') === 'sadmin' ||
            $this->Session->read('Auth.User.role') === 'admin' ? '</li><td><b>AÇÃO</b></td>':''; ?>
    </tr>
    
<?php foreach($livros as $livro){  ?>
        <tr>
            <td><?=$this->Biblioteca->DetalhesLivro($livro['Viewlivrosdetalhe']['id']);?></td>
               <td><?=$livro['Viewlivrosdetalhe']['titulo']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['edicao']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['ano']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['editora']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['localizacao']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['idioma']; ?></td>
               <td><?php
                                $txt = "<ul>";
                                $autor = explode(',',$livro['Viewlivrosdetalhe']['autores']);
                                foreach($autor as $a){
                                    $txt .= '<li>'.str_replace(array('"','{','}'), '',$a).'</li>';
                                }
                                echo '</ul>'.$txt; 
                           ?>
               </td>
              <?= $this->Session->read('Auth.User.role') === 'sadmin' ||
            $this->Session->read('Auth.User.role') === 'admin' ?  
               '<td>
                   '.$this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Livros', 'action' => 'edit',$livro['Viewlivrosdetalhe']['id']),
                        array('escape' => false, 'title' => "Editar")).
                   
                 ' | '.$this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Livros', 'action' => 'delete',$livro['Viewlivrosdetalhe']['id']), 
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este livro?").'</td> ' : ''; ?>

        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>