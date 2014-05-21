<?php
echo $this->Html->script('jquery', false);
$this->set("title_for_layout", 'Novo Livro');
$this->assign('fastwork',$this->Html->link(' INÍCIO ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' LIVROS ',array('controller' => 'Livros', 'action' => 'index')).
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');

        echo    $this->Form->create('Livro',array( 'action' => 'add')),
                $this->Form->input('titulo_id',array('type' => 'hidden', 
                    'value'=> '0', 'id' => 'titulo_id')),
                $this->Form->input('titulo',array(
                    'id' => 'titulo',
                    'type' => 'text', 'class' => 'autocomplete'
                )),
                
                $this->Form->input('editora_id',array
                  ('options'=>$editoras, 'empty' => 'Selecione a editora')),
                $this->Form->input('Livro.cod_barras'),
                $this->Form->input('Livro.edicao'),
                $this->Form->input('Livro.obs'),
                $this->Form->input('Livro.ano'),
                $this->Form->input('idioma_id',array
                  ('options'=>$idiomas, 'empty' => 'Selecione o idioma')),
                $this->Form->input('Livro.data_aquisicao'),
              $this->Form->end('cadastrar');
        
        $scrip = 'var availableTags = [';
                foreach($titulos as $key => $al){
                        $scrip .= '{label:"'.$al.'" , value:"'.$key.'" },';
                }
                $scrip = substr($scrip, 0, strlen($scrip)-1);
                $scrip .= '];
                    $(function(){$( ".autocomplete" ).autocomplete(
                        {
                            source:availableTags,
                            select: function( event, ui ) {
                                $( "#titulo_id" ).val(ui.item.value);
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
?>
