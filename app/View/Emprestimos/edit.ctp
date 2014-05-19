<?php
echo $this->Html->link('BIBLIOTECA','../')   .' > '.
        $this->Html->link('EMPRESTIMOS',array('controller' => 'Emprestimos', 'action' => 'index'))
        .' > <b>NOVO</b>';
?>
<h1>Editar Escola</h1>

<?php  
    <?php  
    echo $this->Html->script('jquery', false);
    echo $this->Html->script('jquery-ui', false);
    echo $this->Html->css('jquery-ui', null, array('inline' => false));
    if(isset($livros)){
        echo    $this->Form->create('Emprestimo',array( 'action' => 'edit')),
                $this->Form->input('livro_id',array
                  ('options'=>$livros, 'empty' => 'Selecione o livro')),
                $this->Form->input('aluno_id',array('type' => 'hidden', 'value'=> '0', 'id' => 'aluno_id')),
                $this->Form->input('aluno',array(
                    'id' => 'nome',
                    'type' => 'text', 'class' => 'autocomplete'
                        )),
       
        $this->Form->end('Salvar');
        
        $scrip = 'var availableTags = [';
        foreach($alunos as $key => $al){
            $scrip .= '{label:"'.$al.'" , value:"'.$key.'" },';
        }
        $scrip = substr($scrip, 0, strlen($scrip)-1);
        $scrip .= '];
           $(function(){$( ".autocomplete" ).autocomplete(
            {
                source:availableTags,
                select: function( event, ui ) {
                    $( "#aluno_id" ).val(ui.item.value);
                    $( ".autocomplete" ).val( ui.item.label);
			return false;
		},focus: function( event, ui ) {
                    $( ".autocomplete" ).val( ui.item.label);
			return false;}
            });});';
        $this->Html->scriptStart(array('inline' => false));
                    echo $scrip;

                    $this->Html->scriptEnd();
                echo $this->Js->writeBuffer();
    }else{
         echo 'Não há livros disponíveis.';
    }
    ?>