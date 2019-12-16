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
                    'title' => "Création d'une liste"
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
        $str =
            <<<END
<form id="formCreateList" method="POST" action="/list/create/submit">
<input type="text" name="titre" placeholder="Titre de la liste">
<input type="text" name="description" placeholder="Description de la liste">
<input type="date" name="date" placeholder="Date d'expiration de la liste">

<button type="submit" name ="valid_create_list" value="valid_f1">Valider</button>
</form>
END;
        return $str;
    }
}