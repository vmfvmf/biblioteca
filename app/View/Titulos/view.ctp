<?php
$this->set("title_for_layout", "Detalhes");  
$this->extend('/Common/view');
$this->start('sidebar');
?>
    <ul>
    </ul>
<?php $this->end(); ?>
<h1>Detalhes Titulo</h1>

<h2><?=$titulo['Titulo']['titulo'];?></h2>
<b>Autor(es)</b>
<ul>
<? foreach($titulo['Autor'] as $autor){
    echo $autor['nome'];
}?>
</ul>
<b>Categorias</b>
<ul>
<? foreach($titulo['Categoria'] as $cat){
    echo $cat['categoria'];
}?>
</ul>

<br/><b>Localização</b> <?=$titulo['Localizacao']['nome'];?>

<br/>

