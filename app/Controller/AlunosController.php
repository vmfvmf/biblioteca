<?php
    class AlunosController extends AppController{
        
        public  $name = "Alunos";
        
        public function index() {
            $this->paginate = array('limit' => 10);//, 'order' => array( 'Livro.' => 'asc'));
            $alunos = $this->paginate('Aluno');
                        
            $this->set(compact('alunos'));
            //pr($autors); exit(0);
        }
        
        public function add(){
            if ($this->data){
                if($this->Aluno->save($this->data)){
                    $this->Session->setFlash(__('Aluno cadastrado.', null),
                            'default', 
                             array('class' => 'notice success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
        
        public function edit($id = null){
            if (!$id) {
                throw new NotFoundException(__('Invalid aluno'));
            }
            $aluno = $this->Aluno->findById($id);
            if (!$aluno) {
                throw new NotFoundException(__('Invalid aluno'));
            }
            if ($this->request->is(array('$aluno', 'put'))) {
                $this->Aluno->id = $id;
            if ($this->Aluno->save($this->request->data)) {
                $this->Session->setFlash(__('Aluno atualizado.', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Não foi possível atualizar aluno.'));
            }
            if (!$this->request->data) {
                $this->request->data = $aluno;
            }
        }
        
        public function delete($id = null){
            if($id){
                if($this->Aluno->delete($id)){
                    $this->Session->setFlash(__('Aluno excluído.', null),
                            'default', 
                             array('class' => 'notice'));
                }
                $this->redirect(array('controller' => 'Alunos', 'action' => 'index'));
            }
        }
        
        public function getCategorias(){
            $categorias = $this->Titulo->Categoria->find('list',array('fields' => array( 'id', 'categoria'),
                                'order'=>'categoria'));
            $this->set(compact('categorias'));
        }
        
        public function view($id = null){
            if($id){
                $titulo = $this->Titulo->read(null, $id);
                $this->set(compact("titulo"));
                self::getLocalizacao();
            self::getAutors();
            self::getCategorias();
                //pr($titulo);exit(0);
            }
        }
        
        public function getAutors(){
            $autors = $this->Titulo->Autor->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('autors'));
        }
        
        
        
        public function getLocalizacao(){
            $localizacao = $this->Titulo->Localizacao->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('localizacao'));
        }
        
     /*   function auto_complete() { 
            $localizacaos = $this->Localizacao->find('all', array( 
                'conditions' => array( 
                    'Localizacao.nome LIKE' => $this->params['url']['autoCompleteText'].'%' 
                ), 
                'fields' => array('nome'), 
                'limit' => 3, 
                'recursive'=>-1, 
            )); 
            $localizacaos2 = Set::Extract($localizacaos,'{n}.Localizacao.nome'); 
            $this->set('localizacaos', $localizacaos2); 
            $this->layout = 'ajax';     
          } */
    }      
?>