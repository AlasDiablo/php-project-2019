<?php

namespace mywishlist\views;

use mywishlist\utils\Selection;

class ListView
{

    protected $list, $selecteur, $content;

    public function  __construct($l, $s){
        $this->list = $l;
        $this->selecteur = $s;
    }

    private function buildListTable($array)
    {
        $out = <<<END
<table>
    <th>titre</th>
    <th>description</th>
    <th>expiration</th>
END;
        foreach ($array as $values)
        {
            $out .= <<<END
    <tr>
        <td>$values->titre</td>
        <td>$values->description</td>
        <td>$values->expiration</td>
    </tr>
END;
        }
        return $out . '</table>';
    }

    private function displayAllList()
    {
        $res = '<h1>Mes listes</h1>';
        $res .= $this->buildListTable($this->list['myLists']);
        $res .= '<h1>Listes ou je participe</h1>';
        $res .= $this->buildListTable($this->list['participLists']);
        return $res;
    }

    private function displayOneList()
    {
        $res = "</table>" . "<table><th>ID</th><th>liste_ID</th><th>nom</th><th>description</th><th>tarif</th>";
        foreach ($this->list as $i)
        {
            $res .= <<<RES
<tr>
    <td>$i->id</td>
    <td>$i->liste_id</td>
    <td>$i->nom</td>
    <td>$i->descr</td>
    <td>$i->tarif</td>
</tr>
RES;
        }
        return $res . "</table>";
    }

    private function formCreateList(){
        $str =
            <<<END
<form id="formCreateList" method="POST" action="/index.php/list/create/submit">
    <input type="text" name="titre" placeholder="Titre de la liste">
    <input type="text" name="description" placeholder="Description de la liste">
    <input type="date" name="date" placeholder="Date d'expiration de la liste">
    <button type="submit" name ="valid_create_list" value="valid_f1">Valider</button>
</form>
END;
        return $str;
    }

    private function share(){
        $link = "http://$_SERVER[HTTP_HOST]";
        $token = $this->list[0]['tokenPart'];
        $id = $this->list[0]['no'];
        $str =
            <<<END
url: $link/index.php/list/display?id=$id&token=$token<br>
END;
        return $str;
    }

    public function render()
    {

        switch ($this->selecteur) {
            case Selection::ALL_LIST:
                $this->content = $this->displayAllList();
                break;
            case Selection::ID_LIST:
                $this->content = $this->displayOneList();
                break;
            case Selection::FORM_LIST:
                $this->content = $this->formCreateList();
                break;
            case Selection::SHARE_LIST:
                $this->content = $this->share();
                break;
            default:
                $this->content = "Switch Constant Error";
                break;
        }

         $body = <<<END
<div id="content">
    <div id="content-inner">
         $this->content
    </div>
</div>
END;
        ViewRendering::render($body);

    }

}