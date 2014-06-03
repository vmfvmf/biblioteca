<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Detalhes Livro");  
$this->extend('/Common/view');
$this->assign('fastwork', $this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' LIVROS ',array('controller' => 'Livros', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> DETALHES </b>');

?>

<h2><?=$titulo['Viewtitulosdetalhe']['titulo'];?></h2>
<h3>Autores</h3>
<ul>
<?php
    $txt = "";
    $autor = explode(',',$titulo['Viewtitulosdetalhe']['autores']);
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
    $clas = explode(',',$titulo['Viewtitulosdetalhe']['classificacaos']);
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
    $ass = explode(',',$titulo['Viewtitulosdetalhe']['assuntos']);
    foreach($ass as $a){
        $txt .= '<li>'.str_replace(array('"','{','}'), '',$a).'</li>';
    }
    echo $txt; 
?>       
</ul>
<br/><b>Localização:</b> <?=$titulo['Viewtitulosdetalhe']['localizacao'];?>
<br>
<br>
<h3>Livros</h3>
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
    <?php foreach($livros as $livro){  ?>
        <tr>
               <td><?=$livro[0]['edicao']; ?></td>
               <td><?=$livro[0]['ano']; ?></td>
               <td><?=$livro[0]['editora']; ?></td>
               <td><?=$livro[0]['idioma']; ?></td>
               <td><?=$livro[0]['disponivel']?"Sim":"Não"; ?></td>
               <td><?=$livro[0]['prazo_devolucao']?
                    $livro[0]['prazo_devolucao'] : 
                        '--------'; ?></td>
        </tr>
    <?php  }  ?>

</table>
