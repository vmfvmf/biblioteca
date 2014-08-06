<?php
    class EmprestimosController extends AppController{
        
        public  $name = "Emprestimos";
        
        public function index() {
            $this->paginate = array('limit' => 10, 'recursive' => 0);//, 'order' => array( 'Livro.' => 'asc'));
            $emprestimos = $this->paginate('Viewlte');
            $this->set(compact('emprestimos'));
        }
        
        public function add(){
            if ($this->data){
                if($this->Emprestimo->save($this->data)){
                    $email = $this->Emprestimo->Viewaluno->query(
                            "SELECT email FROM ALUNOS WHERE id = ".$this->data['Emprestimo']['aluno_id']); 
                    $this->Session->setFlash(__('Cadastrado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
                    //self::viewpdf($email[0][0]['email']);
                    return $this->redirect(array('action' => 
                        'viewpdf/'.$email[0][0]['email'].'/'.$this->Emprestimo->id));
                }
            }
            self::getAlunos();
            self::getLivros();
        }
        
        public function edit($id = null){
            if (!$id) {
                throw new NotFoundException(__('Invalid'));
            }
            $emp = $this->Emprestimolivros->findById($id);
            if (!$emp) {
                throw new NotFoundException(__('Invalid'));
            }
            if ($this->request->is(array('emprestimo', 'put'))) {
                $this->Emprestimolivros->id = $id;
            if ($this->Emprestimolivros->save($this->request->data)) {
                $this->Session->setFlash(__('Atualizado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Unable to update your titulo.'));
            }
            if (!$this->request->data) {
                $this->request->data = $emp;
            }
            self::getAlunos();
            self::getLivros();
        }
        
        public function devolver($id = null){
            if($id){
                if(!$this->Emprestimo->realizaDev($id)){
                
                }
                $this->Session->setFlash(__('Devolução bem sucedida!', null),
                            'default', 
                             array('class' => 'notice success'));
                $this->redirect(array('controller' => 'Emprestimos', 'action' => 'index'));
            }
        }
        
        public function prorrogar($id = null){
            if($id){
                if(!$this->Emprestimo->prorrogaPrazo($id)){
                
                }
                $this->Session->setFlash(__('Prazo Prorrogado!', null),
                            'default', 
                             array('class' => 'notice success'));
                $this->redirect(array('controller' => 'Emprestimos', 'action' => 'index'));
            }
        }
        
        public function delete($id = null){
            if($id){
                if($this->Emprestimolivros->delete($id)){
                    $this->Session->setFlash(__('Deletado com sucesso!', null),
                            'default', 
                             array('class' => 'notice'));
                }
                $this->redirect(array('controller' => 'Emprestimolivros', 'action' => 'index'));
            }
        }
        
        public function view($id = null){
            if($id){
                $emprestimo = $this->Emprestimo->Viewlte->findById($id);
                $this->set(compact("emprestimo"));
            }               
        }
       
        function viewpdf($email,$emp_id){ 
            $emprestimos = $this->Emprestimo->Viewlte->query(
                    "SELECT * FROM Viewltes WHERE emprestimo_id = ".$emp_id); 
            $this->set(compact("email"));
            $this->set(compact("emprestimos"));
            $this->layout = 'pdf'; //this will use the pdf.ctp layout 
            $this->render();
        }
       
        
        public function getLivro(){
           $this->Emprestimolivro->Livro->Behaviors->load('Containable');
           $livro = $this->Emprestimo->Livro->find('all');
           $this->set(compact('livro'));
           //pr($livro); exit(0);
        }
        
        public function getAlunos(){
            $alunos = $this->Emprestimo->Viewaluno->find('list', array('fields'=>array('aluno_id','ra')));
            if(isset($alunos)){
                $this->set(compact('alunos'));
            }else{
                $this->Session->setFlash(__('Não há alunos cadastrados!', null));
                return $this->redirect(array('action' => 'index'));
            }
        }
        
        public function aluno_nome($id = null){
            if(!$id){ return "Não há cadastro";}
            $a = $this->Emprestimo->Viewaluno->query("SELECT nome FROM Viewalunos WHERE aluno_id =".$id);
            $this->set(compact('a'));
            $this->layout = "ajax";
        }
        
        public function livro_detalhes($id = null){
            if(!$id){ return "Não há cadastro";}
            $l = $this->Emprestimo->Viewlivrosdetalhe->find("all",array(
                'conditions' => array('Viewlivrosdetalhe.disponivel' => 'true', 
                    ' Viewlivrosdetalhe.id = ' => $id )));
            $this->set(compact('l'));
            $this->layout = "ajax";
        }
        
        public function email($email,$file){
            App::uses('CakeEmail', 'Network/Email');
            $Email = new CakeEmail('gmail');
            $Email->to($email);
            $Email->from('acessaescoladeitapeva@gmail.com','BIBLIOTECA');
            $Email->addAttachments('/tmp/'.$file);
            $Email->message('teste gjhgjhj jhgh');
            $Email->subject('Comprovante empréstimo');
            if($Email->send()){
                $this->Session->setFlash(__('Comprovante enviado para '.$email.' com sucesso.',
                                null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        
        public function getLivros(){
            $livros = $this->Emprestimo->Livro->find('list', array('fields'=>array('id'),
                'conditions'=>array('Livro.disponivel' => 'true')));
            if($livros){
                $this->set(compact('livros'));
            }else{
                $this->Session->setFlash(__('Não há livros disponíveis!', null));
                return $this->redirect(array('action' => 'index'));
            }
        }
        
    }      
?>
