<?php
    class LocalizacaosController extends AppController{
        
        public  $name = "Localizacaos";
        
        public function index() {
            $this->paginate = array('limit' => 10);//, 'order' => array( 'Livro.' => 'asc'));
            $localizacao = $this->paginate('Localizacao');
                        
            $this->set(compact('localizacao'));
        }
        
        public function add(){
            if ($this->data){
                if($this->Localizacao->save($this->data)){
                    $this->Session->setFlash(__('Cadastrado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
                    return $this->redirect(array('controller' => 'Localizacaos', 'action' => 'index'));
                }
            }
        }
        
        public function edit($id = null){
             if (!$id) {
                throw new NotFoundException(__('Invalid assunto'));
            }
            $ass = $this->Localizacao->findById($id);
            if (!$ass) {
                throw new NotFoundException(__('Invalid assunto'));
            }
            if ($this->request->is(array('$ass', 'put'))) {
                $this->Localizacao->id = $id;
            if ($this->Localizacao->save($this->request->data)) {
                $this->Session->setFlash(__('Atualizado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect(array('controler' => 'Localizacaos','action' => 'index'));
            }
                $this->Session->setFlash(__('Não foi possível atualizar o assunto.'));
            }
            if (!$this->request->data) {
                $this->request->data = $ass;
            }
        }
        
        public function delete($id = null){
            if($id){
                if($this->Localizacao->delete($id)){
                    $this->Session->setFlash(__('Excluído com sucesso!', null),
                            'default', 
                             array('class' => 'notice'));
                }
                $this->redirect(array('controller' => 'Localizacaos', 'action' => 'index'));
            }
        }
        
        public function view($id = null){
            if($id){
                $copia = $this->Copia->read(null, $id);
                $this->set(compact("copia"));
                //pr($escola);exit(0);
            }
        }
        
        public function getTitulo(){
            $titulo = $this->Livro->Titulo->find('list',array('fields' => array( 'id', 'titulo')));
            $this->set(compact('titulo'));
        }
        
        public function getAutors(){
            $autor = $this->Livro->Autor->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('autor'));
        }
        
        public function getLocalizacao(){
            $localizacao = $this->Livro->Localizacao->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('localizacao'));
        }
        
        function auto_complete() { 
               $localizacao = $this->Localizacao->find('all', array( 
                    'conditions' => array( 
                        'Localizacao.nome LIKE' => $this->params['url']['autoCompleteText'].'%' 
                    ), 
                    'fields' => array('nome'), 
                    'limit' => 3, 
                    'recursive'=>-1
                )); 
                $localizacao = Set::Extract($localizacao,'{n}.Localizacao.nome'); 
                $this->set('localizacao', $localizacao); 
                $this->layout = 'ajax';   
      } 
    }
        
?>
