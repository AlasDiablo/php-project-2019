<?php

namespace mywishlist\views;

use mywishlist\utils\Authentication;
use mywishlist\utils\Selection;
use Slim\Slim;

class ListView
{

    protected $list, $selecteur, $content, $app;

    public function  __construct($l, $s)
    {
        $this->list = $l;
        $this->selecteur = $s;
        $this->app =  $this->app = Slim::getInstance();
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
            $list = $this->app->urlFor('list', array('id' => $values->no));
            $out .= <<<END
    <tr>
        <td><a class="link" href=$list>$values->titre</a></td>
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
        foreach ($this->list['authors'] as $u) {
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
        $res .= "<table><tr><th>image</th><th>nom</th><th>reservation</th></tr>";

        foreach ($this->list['items'] as $i) {
            if (isset($_COOKIE['wishlist_userID']) && $_COOKIE['wishlist_userID'] == $this->list['id']) {
                if (!empty($i->nomReserve)) {
                    $res .= <<<RES
<tr>
    <td>$i->img</td>
    <td><a href="/index.php/item/$i->id">$i->nom</a></td>
    <td>oui</td>
</tr>
RES;
                } else {
                    $res .= <<<RES
<tr>
    <td>$i->img</td>
    <td><a href="/index.php/item/$i->id">$i->nom</a></td>
    <td>non</td>
</tr>
RES;
                }
            } else {
                if (!empty($i->nomReserve)) {
                    $res .= <<<RES
<tr>
    <td>$i->img</td>
    <td><a href="/index.php/item/$i->id">$i->nom</a></td>
    <td>$i->nomReserve</td>
</tr>
RES;
                } else {
                    $res .= <<<RES
<tr>
    <td>$i->img</td>
    <td><a href="/index.php/item/$i->id">$i->nom</a></td>
    <td>non</td>
</tr>
RES;
                }
            }
        }
        $id = $this->list['id'];
        $res .= "</table>";
        if ($this->list['authors'][0]['username'] == Authentication::getUsername()) {
            $res .= "<button type=\"button\" onclick=\"window.location.href = '/list/$id/addItem';\" value=\"goToCreateList\">Créer un item</button>";
        }
        return $res . "</div>";
    }

    private function formCreateList(){
        $createList = $this->app->urlFor('listCreateP');
        $str =
            <<<END
<div id="edit">
    <h1>Creation d'une liste</h1>
    <form id="formCreateList" method="POST" action=$createList>
        <input type="text" name="titre" placeholder="Titre de la liste" required>
        <input type="text" name="description" placeholder="Description de la liste" required>
        <input type="date" name="date" placeholder="Date d'expiration de la liste" required>
        <button type="submit" name ="valid_create_list" value="valid_f1">Valider</button>
    </form>
</div>
END;
        return $str;
    }

    private function formModifyList()
    {
        $id = $this->list[0]['no'];
        $modifyList = $this->app->urlFor('listModP', array('id' => $this->list->no));
        $str =
            <<<END
<div id="edit">
    <h1>Modification d'une liste</h1>
    <form id="formModifyList" method="POST" action=$modifyList>
        <input type="text" name="titre" placeholder="Titre de la liste" required>
        <input type="text" name="description" placeholder="Description de la liste" required>
        <input type="date" name="date" placeholder="Date d'expiration de la liste" required>
        <button type="submit" name ="valid_modify_list" value="valid_f1">Valider</button>
    </form>
</div>

END;
        return $str;
    }

    private function share()
    {
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
