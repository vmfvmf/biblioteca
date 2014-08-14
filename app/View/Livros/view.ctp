<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Detalhes Livro");  
$this->extend('/Common/view');
$this->assign('fastwork', $this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' LIVROS ',array('controller' => 'Livros', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> DETALHES </b>');
if($this->Session->read('Auth.User.role') === 'sadmin' ||
        $this->Session->read('Auth.User.role') === 'admin'){
$this->start('sidebar');

if(!$livro['Viewlivrosdetalhe']['disponivel']) 
    echo '<li>'.$this->Biblioteca->DevolverLivroLink($livro['Viewlivrosdetalhe']['id']).'</li>';
    
    $date1 = date_create($this->Time->format($livro['Viewlivrosdetalhe']['prazo_devolucao'],"%Y/%m/%d"));
                             $date2 = new DateTime();
                             $date2->format("%Y/%m/%d");
                             $diff=date_diff($date1,$date2,false);
                             if($diff->days >= 0 && $diff->invert>0) echo " <br/><li> " .
                                 $this->Biblioteca->ProrrogarPrazoLink($livro['Viewlivrosdetalhe']['id']). '</li>';
?>
<br/><li><?=$this->Biblioteca->NovoLivro();?></li>
<br/><li><?=$this->Biblioteca->BuscarLivro();?></li>
<br/><li><?=$this->Biblioteca->TodosLivros();?></li>
<br/><li><?=$this->Biblioteca->TodosEmprestimosLivro($livro['Viewlivrosdetalhe']['id']);?></li>

<?php 
    $this->end(); 
}
?>

<h2><?=$livro['Viewlivrosdetalhe']['titulo'];?></h2>
<h3>Autores</h3>
<ul>
<?php
    $txt = "";
    $autor = explode(',',$livro['Viewlivrosdetalhe']['autores']);
    foreach($autor as $a){
        $txt .= '<li>'.str_replace(array('"','{','}'), '',$a).'</li>';
    }
    echo $txt; 
?>       
</ul>
<br>
<h3>Classificações</h3>
<ul>
<?php
    $txt = "";
    $clas = explode(',',$livro['Viewlivrosdetalhe']['classificacaos']);
    foreach($clas as $a){
        $txt .= '<li>'.str_replace(array('"','{','}'), '',$a).'</li>';
    }
    echo $txt; 
?>       
</ul>
<br>
<h3>Assuntos</h3>
<ul>
<?php
    $txt = "";
    $ass = explode(',',$livro['Viewlivrosdetalhe']['assuntos']);
    foreach($ass as $a){
        $txt .= '<li>'.str_replace(array('"','{','}'), '',$a).'</li>';
    }
    echo $txt; 
?>       
</ul>
<br><b>Localização:</b> <?=$livro['Viewlivrosdetalhe']['localizacao'];?>
<br>
<br>
<table style='clear: none !important; float:right; width:76%; margin: 0 auto !important'>
    <tr>
            <td><b>EDIÇÃO</b></td> 
            <td><b>ANO</b></td> 
            <td><b>EDITORA</b></td> 
            <td><b>IDIOMA</b></td>
            <td><b>DISPONÍVEL</b></td>
            <td><b>PRAZO DEVOLUÇÃO</b></td>
    </tr>
        <tr>
               <td><?=$livro['Viewlivrosdetalhe']['edicao']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['ano']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['editora']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['idioma']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['disponivel']?"Sim":"Não"; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['prazo_devolucao']?
                    $livro['Viewlivrosdetalhe']['prazo_devolucao'] : 
                        '--------'; ?></td>
        </tr>

</table>
