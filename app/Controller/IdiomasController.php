<?php
    class IdiomasController extends AppController{
        
        public  $name = "Idiomas";
        
        public function index() {
            $this->paginate = array('limit' => 10);//, 'order' => array( 'Livro.' => 'asc'));
            $idiomas = $this->paginate('Idioma');
                        
            $this->set(compact('idiomas'));
            //pr($autors); exit(0);
        }
        
        public function add(){
            if ($this->data){
                if($this->Idioma->save($this->data)){
                    $this->Session->setFlash(__('Idioma cadastrada.', null),
                            'default', 
                             array('class' => 'notice success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
        
        public function edit($id = null){
            if (!$id) {
                throw new NotFoundException(__('Invalid editora'));
            }
            $ass = $this->Idioma->findById($id);
            if (!$ass) {
                throw new NotFoundException(__('Invalid editora'));
            }
            if ($this->request->is(array('$ass', 'put'))) {
                $this->Idioma->id = $id;
            if ($this->Idioma->save($this->request->data)) {
                $this->Session->setFlash(__('Idioma cadastrado', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Não foi possível atualizar idioma.'));
            }
            if (!$this->request->data) {
                $this->request->data = $ass;
            }
        }
        
        public function delete($id = null){
            if($id){
                if($this->Idioma->delete($id)){
                    $this->Session->setFlash(__('Idioma excluído', null),
                            'default', 
                             array('class' => 'notice'));
                }
                $this->redirect(array('controller' => 'Idiomas', 'action' => 'index'));
            }
        }
    }      
?>