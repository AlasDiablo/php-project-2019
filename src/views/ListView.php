<?php


namespace mywishlist\views;


use mywishlist\utils\Registries;

class ListView implements IView
{

    public function render($code, $data_set): array{
        switch ($code){
            case Registries::FORMCREATELIST:
                return array(
                    'css' => '',
                    'html' => $this->formCreateList(),
                    'title' => "Create list"
                );
                break;
            default:
                return array(
                    'css' => '',
                    'html' => "<p>404</p>",
                    'title' => "error"
                );
                break;
        }
    }

    private function formCreateList(){
        $str = "<form id=\"formCreateList\" method=\"POST\" action=\"/list/create\">
                        <input type=\"text\" placeholder=\"Titre de la liste\">
                        <input type=\"text\" placeholder=\"Description de la liste\">
                        <input type=\"date\" placeholder=\"Date d'expiration de la liste\">
                </form>";

    }
}