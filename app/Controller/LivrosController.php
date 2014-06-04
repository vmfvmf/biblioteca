<?php
    class LivrosController extends AppController{
        
        public  $name = "Livros";
        
        public function index() {
            $this->paginate = array('limit' => 10, 'recursive' => 1,
              'order' => array( 'Viewlivrosdetalhe.titulo' => 'asc'));
            $livros = $this->paginate('Viewlivrosdetalhe');
            $this->set(compact('livros'));
        }
        
        public function add(){
            if ($this->data){
                if($this->Livro->save($this->data)){
                    $this->Session->setFlash(__('Adicionado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            self::getTitulosList();
            self::getEditoras();
            self::getIdiomas();
        }
        
        function beforeFilter() {
            parent::beforeFilter(); 
            $this->Auth->allow('buscar','display','resultado','index','view'); 
        }
        
        public function edit($id = null){
            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }
            $livro = $this->Livro->findById($id);
            if (!$livro) {
                throw new NotFoundException(__('Invalid Livro'));
            }
            if ($this->request->is(array('livro', 'put'))) {
                $this->Livro->id = $id;
            if ($this->Livro->save($this->request->data)) {
                $this->Session->setFlash(__('Atualizado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Unable to update your livro.'));
            }
            if (!$this->request->data) {
                $this->request->data = $livro;
            }
            self::getTitulosList();
            self::getEditoras();
            self::getIdiomas();
        }
        
        public function delete($id = null){
            if($id){
                if($this->Livro->delete($id)){
                    $this->Session->setFlash(__('Excluído com sucesso!', null),
                            'default', 
                             array('class' => 'notice'));
                }
                $this->redirect(array('controller' => 'Livros', 'action' => 'index'));
            }
        }
        
        public function resultado($tipo = null, $valor = null){
            if($tipo && $valor){
                switch($tipo){
                    case "titulo":
                        $livros = $this->Livro->Titulo->Viewtitulosdetalhe->query(
                            'SELECT * '
                            . " FROM Viewtitulosdetalhes WHERE titulo ilike '%".$valor."%'"
                            . ' ORDER BY titulo');
                        $this->set(compact('livros'));
                        break;
                    case "autors":
                        $livros_ids = $this->Livro->Titulo->query(
                                'SELECT t.id '
                            . " FROM titulos t "
                            . ' INNER JOIN autors_titulos ta ON'
                                . ' t.id = ta.titulo_id'
                                . ' WHERE ta.autor_id IN ('.$valor.')');
                        $valor = "";
                        foreach($livros_ids as $id){
                           $valor .=  $id[0]['id'].',';
                        }
                        $valor = substr($valor,0,  strlen($valor)-1);
                        if($valor){
                            $livros = $this->Livro->Titulo->Viewtitulosdetalhe->query(
                                'SELECT * '
                                . " FROM Viewtitulosdetalhes WHERE id in (".$valor.")"
                                . ' ORDER BY titulo');
                            $this->set(compact('livros'));
                        }
                        //pr($valor);exit(0);*/
                        break;
                    case "classificacaos":
                        $livros_ids = $this->Livro->Titulo->query(
                                'SELECT t.id '
                            . " FROM titulos t "
                            . ' INNER JOIN classificacaos_titulos ta ON'
                                . ' t.id = ta.titulo_id'
                                . ' WHERE ta.classificacao_id IN ('.$valor.')');
                        $valor = "";
                        foreach($livros_ids as $id){
                           $valor .=  $id[0]['id'].',';
                        }
                        $valor = substr($valor,0,  strlen($valor)-1);
                        if($valor){
                            $livros = $this->Livro->Titulo->Viewtitulosdetalhe->query(
                                'SELECT * '
                                . " FROM Viewtitulosdetalhes WHERE id in (".$valor.")"
                                . ' ORDER BY titulo');
                            $this->set(compact('livros'));
                        }
                        //pr($valor);exit(0);*/
                        break;
                    case "assuntos":
                        //pr($valor);exit(0);
                        $livros_ids = $this->Livro->Titulo->query(
                                'SELECT t.id '
                            . " FROM titulos t "
                            . ' INNER JOIN assuntos_titulos ta ON'
                                . ' t.id = ta.titulo_id'
                                . ' WHERE ta.assunto_id IN ('.$valor.')');
                        if($livros_ids){
                            $valor = "";
                            foreach($livros_ids as $id){
                               $valor .=  $id[0]['id'].',';
                            }
                            $valor = substr($valor,0,  strlen($valor)-1);
                            if($valor){
                                $livros = $this->Livro->Titulo->Viewtitulosdetalhe->query(
                                    'SELECT * '
                                    . " FROM Viewtitulosdetalhes WHERE id in (".$valor.")"
                                    . ' ORDER BY titulo');
                                $this->set(compact('livros'));
                            }
                        }
                        //pr($valor);exit(0);*/
                        break;
                }
            }else $this->redirect(array('controller' => 'Livros', 'action' => 'buscar'));
        }
        
        public function buscar(){
            if ($this->data){
                switch($this->data["Livro"]["tipo"]){
                    case "titulo":
                        return $this->redirect(array('controller' => 'Livros', 'action' => 'resultado',
                            $this->data["Livro"]["tipo"],$this->data["Livro"]["titulo"]));
                    case "autors":
                        $var = "";
                        foreach($this->data["Livro"]["Autor"] as $v){
                            $var .= $v.',';
                        }
                        $var = substr($var,0,  strlen($var)-1);
                        return $this->redirect(array('controller' => 'Livros', 'action' => 'resultado',
                            $this->data["Livro"]["tipo"],$var));
                    case "classificacaos":
                        $var = "";
                        foreach($this->data["Livro"]["Classificacao"] as $v){
                            $var .= $v.',';
                        }
                        $var = substr($var,0,  strlen($var)-1);
                        return $this->redirect(array('controller' => 'Livros', 'action' => 'resultado',
                            $this->data["Livro"]["tipo"],$var));
                    case "assuntos":
                        $var = "";
                        foreach($this->data["Livro"]["Assunto"] as $v){
                            $var .= $v.',';
                        }
                        $var = substr($var,0,  strlen($var)-1);
                        return $this->redirect(array('controller' => 'Livros', 'action' => 'resultado',
                            $this->data["Livro"]["tipo"],$var));
                        
                }
                
            }
            self::getTitulosList();
            self::getEditoras();
            self::getIdiomas();
            self::getAutors();
            self::getClassificacaos();
            self::getAssuntos();
        }
        
        public function view($id = null){
            if($id){
                $livros = $this->Livro->Titulo->Viewlivrosdetalhe->query(
                            'SELECT * '
                            . " FROM Viewlivrosdetalhes WHERE id = ".$id
                            . ' ORDER BY disponivel desc');
                $this->set(compact("livros"));
                $titulo = $this->Livro->Titulo->Viewtitulosdetalhe->read(null, $livros[0][0]['titulo_id']);
                $this->set(compact("titulo"));
            }
        }
        
        public function getTitulosList(){
            $titulos = $this->Livro->Titulo->find('list',array('fields' => array( 'id', 'titulo'),
                                'order'=>'titulo'));
            $this->set(compact('titulos'));
        }
        
        public function getClassificacaos(){
            $classificacaos = $this->Livro->Titulo->Classificacao->find('list',array(
                'fields' => array( 'id', 'classificacao'),
                                'order'=>'classificacao'));
            $this->set(compact('classificacaos'));
        }
        
        public function getAssuntos(){
            $assuntos = $this->Livro->Titulo->Assunto->find('list',array(
                'fields' => array( 'id', 'assunto'),
                                'order'=>'assunto'));
            $this->set(compact('assuntos'));
        }
        
        
        public function getAutors(){
            $autor = $this->Livro->Titulo->Autor->find('list',array('fields' => array( 'id', 'autor'),
                                'order'=>'autor'));
            $this->set(compact('autor'));
        }
        public function getIdiomas(){
            $idiomas = $this->Livro->Idioma->find('list',array('fields' => array( 'id', 'idioma'),
                                'order'=>'idioma'));
            $this->set(compact('idiomas'));
        }
        
        public function getEditoras(){
            $editoras = $this->Livro->Editora->find('list',array('fields' => array( 'id', 'editora'),
                                'order'=>'editora'));
            $this->set(compact('editoras'));
        }
        
        public function barcode(){
            
        }
        
    }
        
?>
