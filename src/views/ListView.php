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
    <tr>
        <th>titre</th>
        <th>description</th>
        <th>expiration</th>
    </tr>
END;
        foreach ($array as $values)
        {
            $out .= <<<END
    <tr>
        <td><a class="link" href="/list/$values->no">$values->titre</a></td>
        <td>$values->description</td>
        <td>$values->expiration</td>
    </tr>
END;
        }
        return $out . '</table>';
    }

    private function displayAllList()
    {
        $res = '<div id="myLists"><h1>Mes listes</h1>';
        $res .= $this->buildListTable($this->list['myLists']);
        $res .= "<button type=\"button\" onclick=\"window.location.href = '/list/create';\" value=\"goToCreateList\">Créer un nouvelle liste</button>";
        $res .= '</div>';
        $res .= '<div id="listsByOthers"><h1>Listes ou je participe</h1>';
        $res .= $this->buildListTable($this->list['participLists']);
        $res .= '</div>';
        return $res;
    }

    private function displayOneList()
    {
        $res = '<div id="authors">';
        $i = 0;
        foreach ($this->list['authors'] as $u)
        {
            if ($i != 0) $res .= '<br>';
            $i++;
            $gravatar = $u['gravatar'];
            $username = $u['username'];
            $owner = '';
            if ($u['owner'] == true) {
                $owner = ' owner';
            }
            $res .= <<<END
<img alt="$username" class="gravatar$owner" src="$gravatar"><br><label>$username</label>
END;
        }

        $res .= '</div>';

        $res .= '<div id="items">';
        $title = $this->list['title'];
        $desc = $this->list['desc'];
        $exp = $this->list['exp'];
        $res .= "<h1>$title</h1><p>$desc</p><p>$exp</p>";
        $res .= "<table><tr><th>nom</th><th>description</th><th>tarif</th></tr>";

        foreach ($this->list['items'] as $i)
        {
            $res .= <<<RES
<tr>
    <td>$i->nom</td>
    <td>$i->descr</td>
    <td>$i->tarif</td>
</tr>
RES;
        }
        $id = $this->list['id'];
        $res .= "</table> <button type=\"button\" onclick=\"window.location.href = '/list/$id/addItem';\" value=\"goToCreateList\">Créer un items</button>";
        return $res . "</div>";
    }

    private function formCreateList(){
        $str =
            <<<END
<div id="edit">
    <h1>Creation d'une liste</h1>
    <form id="formCreateList" method="POST" action="/index.php/list/create/submit">
        <input type="text" name="titre" placeholder="Titre de la liste" required>
        <input type="text" name="description" placeholder="Description de la liste" required>
        <input type="date" name="date" placeholder="Date d'expiration de la liste" required>
        <button type="submit" name ="valid_create_list" value="valid_f1">Valider</button>
    </form>
</div>
END;
        return $str;
    }

    private function formModifyList(){
        $id = $this->list[0]['no'];
        $str =
            <<<END
<div id="edit">
    <h1>Modification d'une liste</h1>
    <form id="formModifyList" method="POST" action="/index.php/list/$id/modify/submit">
        <input type="text" name="titre" placeholder="Titre de la liste" required>
        <input type="text" name="description" placeholder="Description de la liste" required>
        <input type="date" name="date" placeholder="Date d'expiration de la liste" required>
        <button type="submit" name ="valid_modify_list" value="valid_f1">Valider</button>
    </form>
</div>

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
            case Selection::FORM_CREATE_LIST:
                $this->content = $this->formCreateList();
                break;
            case Selection::FORM_MODIFY_LIST:
                $this->content = $this->formModifyList();
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