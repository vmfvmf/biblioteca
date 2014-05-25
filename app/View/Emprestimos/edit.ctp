<?php
echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
echo $this->Html->css('jquery-ui', null, array('inline' => false));

$this->set("title_for_layout", 'Editar Empréstimo');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' EMPRÉSTIMOS ',array('controller' => 'Emprestimos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> EDITAR </b>');

    if(isset($livros)){
        echo    $this->Form->create(),
                $this->Form->input('livro_id',array
                  ('options'=>$livros)),
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