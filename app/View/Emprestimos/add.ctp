<?php
echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
echo $this->Html->script('ui.multiselect', false);
echo $this->Html->css('ui.multiselect', null, array('inline' => false));
echo $this->Html->css('jquery-ui', null, array('inline' => false));

$this->set("title_for_layout", 'Novo Empréstimo');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' EMPRÉSTIMOS ',array('controller' => 'Emprestimos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');


    if(isset($livros)){
        echo    $this->Form->create(),
                
                $this->Form->input('Livro', array(
                              'label' => __('Livros',true),
                              'id' => 'livro_id',
                              'type' => 'select',
                                'class' => 'multiselect',
                              'multiple' => 'multiple',
                              'options' => $livros,
                    'style' => 'clear: none !important; width:460px; height:200px;'
                )),
                $this->Form->input('aluno_id',array('type' => 'hidden', 
                    'value'=> '0', 'id' => 'aluno_id')),
                $this->Form->input('aluno',array(
                    'id' => 'nome',
                    'type' => 'text', 'class' => 'autocomplete'
                )),
       
                $this->Form->end('cadastrar');
        
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
                    });
                        $(".multiselect").multiselect();
                    });';
        $this->Html->scriptStart(array('inline' => false));
                    echo $scrip;

                    $this->Html->scriptEnd();
                echo $this->Js->writeBuffer();
    }else{
         echo 'Não há livros disponíveis.';
    }
?>

