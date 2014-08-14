<?php
class BibliotecaComponent extends Object {
        function initialize($controller, $settings = array()) {
            // salvando a referência do controller para uso posterior
            $this->controller = $controller;
        }
        //chamado depois do Controller::beforeFilter()
        function startup($controller) {
            
        }

        //chamado depois do Controller::beforeRender()
        function beforeRender($controller) {
        }

        //chamado depois do Controller::render()
        function shutdown($controller) {
        }

        //chamado antes do Controller::redirect()
        function beforeRedirect($controller, $url, $status=null, $exit=true) {
        }

        function redirectSomewhere($value) {
            // utilizando um método de controller
            $this->controller->redirect($value);
        }
}
   