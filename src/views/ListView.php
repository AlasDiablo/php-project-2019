<?php

namespace mywishlist\views;

use DateTime;
use mywishlist\utils\Selection;
use Slim\Slim;

class ListView
{

    protected $list, $selecteur, $content, $app;

    public function  __construct($l, $s)
    {
        $this->list = $l;
        $this->selecteur = $s;
        $this->app = Slim::getInstance();
    }

    private function buildListTable($array, bool $edit)
    {
        $out = <<<END
<table>
    <tr>
        <th>titre</th>
        <th>description</th>
        <th>expiration</th>
    </tr>
END;
        foreach ($array as $values) {
            if ($edit) $link = $this->app->urlFor('list', array('token' => $values->token));
            else $link = $this->app->urlFor('list', array('token' => $values->tokenPart));
            $out .= <<<END
    <tr>
        <td><a class="link" href=$link>$values->titre</a></td>
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
        $res .= $this->buildListTable($this->list['myLists'], true);
        $res .= "<button type=\"button\" onclick=\"window.location.href = '/list/create';\" value=\"goToCreateList\">Créer un nouvelle liste</button>";
        $res .= '</div>';
        $res .= '<div id="listsByOthers"><h1>Listes ou je participe</h1>';
        $res .= $this->buildListTable($this->list['participLists'], false);
        $res .= '</div>';
        return $res;
    }


    private function buildItemList($item, $args): string
    {
        if (!$args['exp']) $out = "<table><tr><th>Image</th><th>Nom</th><th>Status de la reservation</th>";
        else $out = "<table><tr><th>Image</th><th>Nom</th><th>Reservation par</th><th>Message</th>";
        if ($args['p']) $out .= '<th>Modifier l\'item</th></tr>';
        else $out .= '<th>Reservé l\'item</th></tr>';

        foreach ($item as $key => $value)
        {
            $url = $this->app->urlFor('manageItemFromList', array('token' => $args['token'], 'item' => $value->id));
            $editable = (!empty($value->nomReserve) || $args['exp']) ? 'disabled' : '';
            if (!$args['exp'] && !$args['p']){
                if (!empty($value->nomReserve)) $resv = "Reservé";
                else $resv = "Non réservé";
                $out .= "<tr><td>$value->img</td><td>$value->nom</td><td>$resv</td>";
                $out .= "<td><button type='button' onclick=\"window.location.href = '$url';\" value=\"goToCreateList\" $editable>Modifer l'item</button></td>";
                $out .= "</tr>";
            } else {
                $out .= "<tr><td>$value->img</td><td>$value->nom</td><td>$value->nomReserve</td><td>$value->msgReserve</td>";
                $out .= "<td><button type='button' onclick=\"window.location.href = '$url';\" value=\"goToCreateList\" $editable>Reservé l'item</button></td>";
                $out .= "</tr>";
            }
        }
        return $out . "</table>";
    }

    private function displayOneList($modifiable)
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
        $tokPart = $this->list['tokenPart'];
        $res .= "<h1>$title</h1><p>$desc</p><p>$exp</p>";

        if ($modifiable) {
            if(empty($tokPart))
            {
                $urlShare = $this->app->urlFor('listShare', array('token' => $this->list['token']));
                $res .= "<button type=\"button\" onclick=\"window.location.href = '$urlShare'\" value=\"goToShareList\">Generé un lien de partage</button>";
            }else {
                $urlShare = $_SERVER['SERVER_NAME'] . $this->app->urlFor('list', array('token' => $this->list['tokenPart']));
                $res .= <<<SHARE
<input type="text" value="$urlShare" id="share">

<div class="tooltip">
    <button type="button" onclick="copy()" onmouseout="copy_post()">
      <span id="tooltip_text">Copié dans le pres-papier</span>
      Copié le lien
    </button>
</div>

<script>
function copy() {
  const copyText = document.getElementById("share");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  
  const tooltip = document.getElementById("tooltip_text");
  tooltip.innerHTML = "Copié: " + copyText.value;
}

function copy_post() {
  const tooltip = document.getElementById("tooltip_text");
  tooltip.innerHTML = "Copié dans le pres-papier";
}
</script>
SHARE;

            }
        }

        $exp = DateTime::createFromFormat('Y-m-d', $exp);
        $now = new DateTime('now');
        if ($modifiable) {
            if ($exp >= $now) $array = array('p' => false, 'exp' => false, 'token' => $this->list['token']);
            else $array = array('p' => false, 'exp' => true, 'token' => $this->list['token']);
        } else {
            if ($exp >= $now) $array = array('p' => true, 'exp' => false, 'token' => $this->list['token']);
            else $array = array('p' => true, 'exp' => true, 'token' => $this->list['token']);
        }

        $res .= $this->buildItemList($this->list['items'], $array);

        if ($modifiable && $exp >= $now) {
            $url = $this->app->urlFor('listAddItem', array('token' => $this->list['token']));
            $res .= "<button type=\"button\" onclick=\"window.location.href = '$url'\" value=\"goToShareList\">Ajouté un item</button>";
        }

        return $res . "</div>";
    }

    private function formCreateList()
    {
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
        $modifyList = $this->app->urlFor('listModP', array('id' => $this->list->no));
        return <<<END
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
    }

    public function render()
    {

        switch ($this->selecteur) {
            case Selection::ALL_LIST:
                $this->content = $this->displayAllList();
                break;
            case Selection::TOKEN_LIST_MODIFIABLE:
                $this->content = $this->displayOneList(true);
                break;
            case Selection::TOKEN_LIST:
                $this->content = $this->displayOneList(false);
                break;
            case Selection::FORM_CREATE_LIST:
                $this->content = $this->formCreateList();
                break;
            case Selection::FORM_MODIFY_LIST:
                $this->content = $this->formModifyList();
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
