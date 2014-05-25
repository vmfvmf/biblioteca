<?php
    class RelatoriosController extends AppController{
        
        public  $name = "Relatorios";
        
        public function index() {
            
        }
       
        public function alunos(){
            self::getAlunos();
        }
        
        
        public function getAlunos(){
            $alunos = $this->Relatorio->Aluno->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('alunos'));
        }
        
        public function data($id = null){
            if(!$id){ return "Não há cadastro";}
            $aluno = $this->Relatorio->Aluno->findById($id);
            $dados = $this->Relatorio->Livro->query(
                    'SELECT titulo, min(data_emprestimo) as "min",max(data_emprestimo) as "max", '
                    . ' count(*) as "count" FROM ViewLTEs WHERE aluno_id = '.$id.' GROUP BY titulo '
                    . ' ORDER BY count DESC LIMIT 5');
            $atrasos = $this->Relatorio->Viewlte->query(
                    'SELECT titulo, data_emprestimo,data_devolucao, prazo_devolucao, '
                    . ' extract("days" from data_devolucao) - extract("days" from prazo_devolucao) as "atraso"'
                    . ' FROM ViewLTEs WHERE aluno_id = '.$id.' AND data_devolucao > prazo_devolucao '
                    . ' ORDER BY titulo ASC LIMIT 5');
            $this->set(compact('aluno'));
            $this->set(compact('atrasos'));
            $this->set(compact('dados'));
            $this->layout = "ajax";
            //pr($dados);exit(0);
        }
        
    }
?>