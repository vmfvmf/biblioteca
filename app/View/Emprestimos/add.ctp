<?php
$this->assign('menu-principal', $this->element('menu-principal'));
echo $this->Html->script('jquery', false);
//echo $this->Html->script('custom-combobox', false);
echo $this->Html->script('jquery-ui', false);
echo $this->Html->script('ui.multiselect', false);
echo $this->Html->css('ui.multiselect', null, array('inline' => false));
//echo $this->Html->css('custom-combobox', null, array('inline' => false));
echo $this->Html->css('jquery-ui', null, array('inline' => false));

$this->set("title_for_layout", 'Novo Empréstimo');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' EMPRÉSTIMOS ',array('controller' => 'Emprestimos', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');


    if(isset($livros)){
        echo    $this->Form->create("Emprestimo",array('onsubmit' => 'return itsclicked;')),
                $this->Form->input('aluno',array(
                    'id' => 'nome',
                    'type' => 'text', 'class' => 'autocomplete'
                )),
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
                
       
                $this->Form->submit('cadastrar', array(
                            'onmousedown' =>
                                'itsclicked = true; return true;',
                            'onkeydown' =>
                                'itsclicked = true; return true;'
                ));
        
                $scrip = 'var availableTags = [';
                foreach($alunos as $key => $al){
                        $scrip .= '{label:"'.$al.'" , value:"'.$key.'" },';
                }
                $scrip = substr($scrip, 0, strlen($scrip)-1);
                $scrip .= '];
                    var itsclicked = false;
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
                    /*    $(".autocomplete").bind(
                            "keyup", function(e) {
                                if (e.keyCode == 13) {
                                    alert("enter");
                                }
                        }); */
                    });';
        $this->Html->scriptStart(array('inline' => false));
                    echo $scrip;

                    $this->Html->scriptEnd();
                echo $this->Js->writeBuffer();
    }else{
         echo 'Não há livros disponíveis.';
    }
?>

