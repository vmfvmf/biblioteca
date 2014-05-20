<?php
    class EmprestimosController extends AppController{
        
        public  $name = "Emprestimos";
        
        public function index() {
            $this->paginate = array('limit' => 20, 'recursive' => 2);//, 'order' => array( 'Livro.' => 'asc'));
            $emprestimos = $this->paginate('Emprestimo');
                        
            $this->set(compact('emprestimos'));
        }
        
        public function add(){
            if ($this->data){
                if($this->Emprestimo->save($this->data)){
                    $this->Session->setFlash(__('Emprestimo realizado com sucesso.'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            self::getAlunos();
            self::getLivros();
        }
        
        public function edit($id = null){
            if (!$id) {
                throw new NotFoundException(__('Invalid titulo'));
            }
            $titulo = $this->Titulo->findById($id);
            if (!$titulo) {
                throw new NotFoundException(__('Invalid TItulo'));
            }
            if ($this->request->is(array('titulo', 'put'))) {
                $this->Titulo->id = $id;
            if ($this->Titulo->save($this->request->data)) {
                $this->Session->setFlash(__('Your titulo has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Unable to update your titulo.'));
            }
            if (!$this->request->data) {
                $this->request->data = $titulo;
            }
            self::getLocalizacao();
            self::getAutors();
            self::getCategorias();
        }
        
        public function devolver($id = null){
            if($id){
                if(!$this->Emprestimo->realizaDev($id)){
                
                }
                $this->Session->setFlash("Livro devolvido com sucesso!");
                $this->redirect(array('controller' => 'Emprestimos', 'action' => 'index'));
            }
        }
        
        public function delete($id = null){
            if($id){
                if($this->Emprestimo->delete($id)){
                    $this->Session->setFlash("Emprestimo excluido com sucesso!");
                }
                $this->redirect(array('controller' => 'Emprestimos', 'action' => 'index'));
            }
        }
        
        public function view($id = null){
            if($id){
                $this->Emprestimo->Livro->Behaviors->load('Containable');
                $this->Emprestimo->Behaviors->load('Containable');
                $this->Emprestimo->Livro->Titulo->Behaviors->load('Containable');
                $emprestimo = $this->Emprestimo->read(null, $id);
                $this->set(compact("emprestimo"));
            }
            //self::getAlunos();
            self::getLivro();                
            pr($emprestimo);exit(0);
        }
       
        public function getLivro(){
           $this->Emprestimo->Livro->Behaviors->load('Containable');
           $livro = $this->Emprestimo->Livro->find('all');
           $this->set(compact('livro'));
           //pr($livro); exit(0);
        }
        
        public function getAlunos(){
            $alunos = $this->Emprestimo->Aluno->find('list',array('fields' => array( 'id', 'nome')));
            $this->set(compact('alunos'));
//            pr($alunos);exit(0);
        }
        
        public function getLivros(){
            $livros = $this->Emprestimo->Livro->getLivrosTitulo();
            if($livros){
                foreach($livros as $row) {
                    $id = $row[0]['livro_id'];
                    $name = $row[0]['titulo'];
                    $list[$id] = $name;
                }
                $livros = $list;
                $this->set(compact('livros'));
            }
        }
        
    }      
?>
