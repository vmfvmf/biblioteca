<?php
$this->assign('menu-principal', $this->element('menu-principal'));
    echo $this->Html->script('jquery', false);
    echo $this->Html->script('jquery-ui', false);
    echo $this->Html->css('jquery-ui', null, array('inline' => false));

   echo $this->Form->create(),
        $this->Form->input("aluno_id", array("type"=>"hidden")),
    $this->Form->input("Nome", array("label"=>"Nome", "type" => "text", 
        "id" => 'aluno_id', "class" => "autocomplete"));?>

<div id="rel_div"></div>
    <?php
    $scrip = 'var accentMap = { "ã": "a" , "Ã" : "a", "Â":"a", "â":"a", "à":"a", "À":"a", "á":"a","Á":"a",
                "é":"e" , "è" : "e", "É":"e", "È":"e", 
                "í": "i" , "Í":"i", "Ì":"i", "ì":"i",
                "õ":"o" , "Õ":"o","Ô":"o", "ô":"o", "Ó":"o", "ó":"o", "Ò":"o","ò":"o",
                "ú": "u" , "Ú" : "u", "Ù":"u", "ù":"u", "Ç":"c", "ç":"c"};
            var names = [';
        foreach($alunos as $key => $al){
            $scrip .= '{label:"'.$al.'" , value:"'.$key.'" },';
        }
        $scrip = substr($scrip, 0, strlen($scrip)-1);
        $scrip .= '];
           $(function(){
            var normalize = function( term ) {
                var ret = "";
                for ( var i = 0; i < term.length; i++ ) {
                  ret += accentMap[ term.charAt(i) ] || term.charAt(i);
                }
                return ret;
            };
            $( ".autocomplete" ).autocomplete(
             {
                source: function( request, response ) {
                        var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
                        response( $.grep( names, function( value ) {
                          value = value.label || value.value || value;
                          return matcher.test( value ) || matcher.test( normalize( value ) );
                        }) );
                      },
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