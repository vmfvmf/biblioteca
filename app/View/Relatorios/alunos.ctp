<?php
    echo $this->Html->script('jquery', false);
    echo $this->Html->script('jquery-ui', false);
    echo $this->Html->css('jquery-ui', null, array('inline' => false));

   echo $this->Form->create(),
        $this->Form->input("aluno_id", array("type"=>"hidden")),
    $this->Form->input("Nome", array("label"=>"Nome", "type" => "text", 
        "id" => 'aluno_id', "class" => "autocomplete"));?>

<div id="rel_div"></div>
    <?php
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
                    $.get("data/"+ui.item.value,function(data,status)
                                  { $("#rel_div").html(data);} );
			return false;
		},focus: function( event, ui ) {
                    $( ".autocomplete" ).val( ui.item.label);
			return false;}
            });});';
    $this->Html->scriptStart(array('inline' => false));
    
    echo $scrip.
        '
            $(function() { $( ".autocomplete" ).autocomplete();
            });';
    $this->Html->scriptEnd();
    echo $this->Js->writeBuffer();
    ?>