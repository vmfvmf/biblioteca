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

        echo    $this->Form->create("Emprestimo",array('onsubmit' => 'return itsclicked;')),
                '<h2>Aluno</h2>',
                $this->Form->input('aluno_id',array(
                    'id' => 'ra', 'label' => 'RA',
                    'type' => 'text', 'class' => 'autocomplete'
                )),
                '<div id="rel_div_a"></div><br><hr><br>'
                . '<div id="inner" style="display:none; width: 400px;"></div>',
                $this->Form->input('aluno_id',array('type' => 'hidden', 
                    'value'=> '0', 'id' => 'aluno_id')),
                '<h2>Livros</h2>',
                $this->Form->input('livro_',array(
                    'id' => 'livro_id', 'label' => 'Código de Barras',
                    'type' => 'text', 'class' => 'autocomplete'
                )),
                $this->Form->input('Livro',
                        array("label"=>"",'type' => 'select', "id" => "LivroLivro",
                               'class' => 'multiselect','multiple' => 'multiple',
                            "style" => "height:0;"
                )),
                '<table id="tb_livros"><thead>'
                . '<td><b>COD. BARRAS</b></td>'
                . '<td><b>TÍTULO</b></td>'
                . '<td><b>EDITORA</b></td>'
                . '<td><b>EDIÇÃO</b></td>'
                . '<td><b>CANCELAR</b></td>'
                . '</thead><tbody><td hidden></td></tbody></table>',
                $this->Form->submit('cadastrar', array(
                            'onmousedown' =>
                                'itsclicked = true; return true;',
                            'onkeydown' =>
                                'itsclicked = true; return true;'
                ));
        
                $scrip = 'var availableAlunos = [';
                foreach($alunos as $key => $al){
                        $scrip .= '{label:"'.$al.'" , value:"'.$key.'" },';
                }
                $scrip = substr($scrip, 0, strlen($scrip)-1).'];';
                $scrip .= 'var availableLivros = [';
                foreach($livros as $key){
                        $scrip .= '"'.$key.'",';
                }
                $scrip = substr($scrip, 0, strlen($scrip)-1).'];';
                $scrip .= '
                    $(function(){
                        $( "#ra" ).autocomplete(
                        {
                            source:availableAlunos,
                            select: function( event, ui ) {
                                $( "#aluno_id" ).val(ui.item.value);
                                $( "#ra" ).val( ui.item.label);
                                $.get("aluno_nome/"+ui.item.value,function(data,status)
                                  { $("#rel_div_a").html(data); } );
                                return false;
                        },focus: function( event, ui ) {
                            $( "#ra" ).val( ui.item.label);
                            return false;}
                        }).keyup(function(event) {
                                for (var key in availableAlunos) {
                                    if(availableAlunos[key]["label"] == 
                                        $("#ra").val()){
                                        $.get("aluno_nome/"+availableAlunos[key]["value"],function(data,status)
                                            { $("#rel_div_a").html(data); } );
                                    }
                                }
                        });
                        $( "#livro_id" ).autocomplete(
                        {
                            source:availableLivros,
                            select: function( event, ui ) {
                                var i = $.inArray(ui.item.label,availableLivros);
                                if(i > -1){
                                    $.get("livro_detalhes/"+ui.item.label,function(data,status){
                                        $("#tb_livros tbody tr:last").after(data);
                                        availableLivros.splice(i, 1);
                                        $("#LivroLivro option[value="+ui.item.label+"]").attr("selected","selected");
                                        $(".rem-livro").click(function(){
                                            /*console.log(*/
                                            var chil = $(this).parent().parent().children()[0];
                                            availableLivros.push($(chil).text());
                                            console.log($(chil).text());
                                            $("#LivroLivro option[value="+ui.item.label+"]").attr("selected",false);
                                            $(this).parent().parent().remove();
                                            return false;
                                        });
                                    });
                                }
                                return false;
                        },focus: function( event, ui ) {
                            $( "#livro_id" ).val( ui.item.label);
                            console.log(ui.item.label);
                            return false;}
                        }).keyup(function(event) {
                            if (event.keyCode == 13){
                                $( "#livro_id" ).val("");
                            }
                            return false;
                        }).keydown(function(event) {
                            if (event.keyCode == 13) return false;
                        });
                    });';
        $this->Html->scriptStart(array('inline' => false));
                    echo $scrip;

                    $this->Html->scriptEnd();
                echo $this->Js->writeBuffer();
?>

