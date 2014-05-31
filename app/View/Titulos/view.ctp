<?php
$this->set("title_for_layout", "Detalhes");  

?>
<h2><?=$titulo['Viewtitulosdetalhe']['titulo'];?></h2>
<b>Autor(es)</b>
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
<b>Classificações</b>
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
<b>Assuntos</b>
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

<table>
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
               <td><?=$livro[0]['prazo_devolucao']; ?></td>
        </tr>
    <?php  }  ?>

</table>
