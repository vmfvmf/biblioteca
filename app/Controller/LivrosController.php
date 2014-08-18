<?php

class LivrosController extends AppController {

    public $name = "Livros";
    var $components = array('Barcoder');
    var $uses = array('Livro', 'Viewlivrosdetalhe','Viewtitulosdetalhe', 'Emprestimos_livro');

    public function todos() {
        $this->paginate = array('limit' => 10, 'recursive' => 1,
            'order' => array('Viewlivrosdetalhe.titulo' => 'asc'));
        $livros = $this->paginate('Viewlivrosdetalhe');
        $this->set(compact('livros'));
    }

    public function add() {
        if ($this->data) {
            $textoBarcode = $this->data['Livro']['titulo'] . 'ô' .
                    self::textoBarcode($this->data['Livro']['editora_id']) . ' - ed ' .
                    $this->data['Livro']['edicao'];
            if ($this->data['Livro']['qtd'] == 1) {
                $id = $this->Livro->save($this->data);
                if ($id) {
                    $this->Session->setFlash(__('Adicionado com sucesso!', null), 'default', array('class' => 'notice success'));
                    self::barcoder($id['Livro']['id'], $textoBarcode);
                    return $this->redirect(array('controller' => 'Livros',
                                'action' => 'index'));
                }
            } else {
                $arr = array();
                for ($i = 0; $i < $this->data['Livro']['qtd']; $i++) {
                    $this->Livro->create();
                    array_push($arr, $this->Livro->save($this->data));
                }
                if (count($arr) > 1) {
                    for ($i = 0; $i < count($arr); $i++) {
                        self::barcoder($arr[$i]['Livro']['id'], $textoBarcode);
                    }
                    $this->Session->setFlash(__('Adicionados com sucesso!', null), 'default', array('class' => 'notice success'));
                    return $this->redirect(array('controller' => 'Livros',
                                'action' => 'index'));
                }
            }
        }
        self::getTitulosList();
        self::getEditoras();
        self::getIdiomas();
    }

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('buscar', 'display', 'resultado', 'index', 'view', 'livros');
    }

    public function edit($id = null) {
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
                $this->Session->setFlash(__('Atualizado com sucesso!', null), 'default', array('class' => 'notice success'));
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

    public function delete($id = null) {
        if ($id) {
            if ($this->Livro->delete($id)) {
                $this->Session->setFlash(__('Excluído com sucesso!', null), 'default', array('class' => 'notice'));
            }
            $this->redirect(array('controller' => 'Livros', 'action' => 'index'));
        }
    }

    public function checkRetornoBusca($variavel = null) {
        if (!$variavel) {
            $this->Session->setFlash(__('A busca não encontrou livros!', null), 'default', array('class' => 'notice error'));
            return $this->redirect(array('controller' => 'Livros', 'action' => 'index'));
        }
    }

    public function resultado($tipo = null, $valor = null) {
        if ($tipo && $valor) {
            switch ($tipo) {
                case "titulo":
                    $livros = $this->Viewtitulosdetalhe->find('all',array(
                        'conditions' => array("Viewtitulosdetalhe.titulo ilike '%".$valor."%'"),
                        'order' => 'titulo'));
                    $this->set(compact('livros'));
                    self::checkRetornoBusca($livros);
                    break;
                case "autors":
                    $livros_ids = $this->Livro->Titulo->query(
                            'SELECT t.id '
                            . " FROM titulos t "
                            . ' INNER JOIN autors_titulos ta ON'
                            . ' t.id = ta.titulo_id'
                            . ' WHERE ta.autor_id IN (' . $valor . ')');
                    $valor = "";
                    self::checkRetornoBusca($livros_ids);
                    foreach ($livros_ids as $id) {
                        $valor .= $id[0]['id'] . ',';
                    }
                    $valor = substr($valor, 0, strlen($valor) - 1);
                    if ($valor) {
                        $livros = $this->Viewtitulosdetalhe->find('all',array(
                            'conditions' => array("id IN (".$valor.")"),
                            'order' => 'titulo'));
                        $this->set(compact('livros'));
                    }
                    break;
                case "classificacaos":
                    $livros_ids = $this->Livro->Titulo->query(
                            'SELECT t.id '
                            . " FROM titulos t "
                            . ' INNER JOIN classificacaos_titulos ta ON'
                            . ' t.id = ta.titulo_id'
                            . ' WHERE ta.classificacao_id IN (' . $valor . ')');
                    $valor = "";
                    self::checkRetornoBusca($livros_ids);
                    foreach ($livros_ids as $id) {
                        $valor .= $id[0]['id'] . ',';
                    }
                    $valor = substr($valor, 0, strlen($valor) - 1);
                    if ($valor) {
                        $livros = $this->Viewtitulosdetalhe->find('all',array(
                            'conditions' => array("id IN (".$valor.")"),
                            'order' => 'titulo'));
                        $this->set(compact('livros'));
                    }
                    break;
                case "assuntos":
                    $livros_ids = $this->Livro->Titulo->query(
                            'SELECT t.id '
                            . " FROM titulos t "
                            . ' INNER JOIN assuntos_titulos ta ON'
                            . ' t.id = ta.titulo_id'
                            . ' WHERE ta.assunto_id IN (' . $valor . ')');
                    self::checkRetornoBusca($livros_ids);
                    $valor = "";
                    foreach ($livros_ids as $id) {
                        $valor .= $id[0]['id'] . ',';
                    }
                    $valor = substr($valor, 0, strlen($valor) - 1);
                    if ($valor) {
                      $livros = $this->Viewtitulosdetalhe->find('all',array(
                            'conditions' => array("id IN (".$valor.")"),
                            'order' => 'titulo'));
                        $this->set(compact('livros'));
                    }
                    break;
            }
        }
    }

    public function index() {
        if ($this->data) {
            switch ($this->data["Livro"]["tipo"]) {
                case "codbarras":
                    return $this->redirect(array('controller' => 'Livros', 'action' => 'view',
                                $this->data["Livro"]["codbarras"]));
                case "titulo":
                    return $this->redirect(array('controller' => 'Livros', 'action' => 'resultado',
                                $this->data["Livro"]["tipo"], $this->data["Livro"]["titulo"]));
                case "autors":
                    $var = "";
                    foreach ($this->data["Livro"]["Autor"] as $v) {
                        $var .= $v . ',';
                    }
                    $var = substr($var, 0, strlen($var) - 1);
                    return $this->redirect(array('controller' => 'Livros', 'action' => 'resultado',
                                $this->data["Livro"]["tipo"], $var));
                case "classificacaos":
                    $var = "";
                    foreach ($this->data["Livro"]["Classificacao"] as $v) {
                        $var .= $v . ',';
                    }
                    $var = substr($var, 0, strlen($var) - 1);
                    return $this->redirect(array('controller' => 'Livros', 'action' => 'resultado',
                                $this->data["Livro"]["tipo"], $var));
                case "assuntos":
                    $var = "";
                    foreach ($this->data["Livro"]["Assunto"] as $v) {
                        $var .= $v . ',';
                    }
                    $var = substr($var, 0, strlen($var) - 1);
                    return $this->redirect(array('controller' => 'Livros', 'action' => 'resultado',
                                $this->data["Livro"]["tipo"], $var));
            }
        }
        self::getTitulosList();
        self::getEditoras();
        self::getIdiomas();
        self::getAutors();
        self::getClassificacaos();
        self::getAssuntos();
    }

    public function view($id = null) {
        if ($id) {
            $livro = $this->Viewlivrosdetalhe->find('first', array(
                'conditions' => array('id =' => $id),
                'order' => array('disponivel' => 'desc')));
            if ($livro) {
                $this->set(compact("livro"));
                $id_emp_livro = $this->Emprestimos_livro->find('first',array(
                    'conditions'=>array('livro_id'=>$id), 'fields' => 'max(id)'
                ));
                //pr($id_emp_livro);exit(0);
                $id_emp_livro = $id_emp_livro[0]['max'];
                $this->set(compact("id_emp_livro"));
            } else {
                $this->Session->setFlash(__('Livro não encontrado!', null), 'default', array('class' => 'notice error'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function getTitulosList() {
        $titulos = $this->Livro->Titulo->find('list', array('fields' => array('id', 'titulo'),
            'order' => 'titulo'));
        $this->set(compact('titulos'));
    }

    public function getClassificacaos() {
        $classificacaos = $this->Livro->Titulo->Classificacao->find('list', array(
            'fields' => array('id', 'classificacao'),
            'order' => 'classificacao'));
        $this->set(compact('classificacaos'));
    }

    public function getAssuntos() {
        $assuntos = $this->Livro->Titulo->Assunto->find('list', array(
            'fields' => array('id', 'assunto'),
            'order' => 'assunto'));
        $this->set(compact('assuntos'));
    }

    public function getAutors() {
        $autor = $this->Livro->Titulo->Autor->find('list', array('fields' => array('id', 'autor'),
            'order' => 'autor'));
        $this->set(compact('autor'));
    }

    public function getIdiomas() {
        $idiomas = $this->Livro->Idioma->find('list', array('fields' => array('id', 'idioma'),
            'order' => 'idioma'));
        $this->set(compact('idiomas'));
    }

    public function getEditoras() {
        $editoras = $this->Livro->Editora->find('list', array('fields' => array('id', 'editora'),
            'order' => 'editora'));
        $this->set(compact('editoras'));
    }

    public function barcoder($id = null, $text = null) {
        $this->Barcoder->barcode();
        $this->Barcoder->setType('C128');
        $this->Barcoder->setCode($id);
        $this->Barcoder->setSize(80, 160);
        $this->Barcoder->setText($text);
        $this->Barcoder->writeBarcodeFile('img/barcode/code_' . $id . '.png');
    }

    public function textoBarcode($editoraId) {
        $txt = $this->Livro->Editora->find('all', array(
            'fields' => array('editora'),
            'conditions' => array('id =' => $editoraId)
        ));
        return $txt[0]['Editora']['editora'];
    }

}

?>
