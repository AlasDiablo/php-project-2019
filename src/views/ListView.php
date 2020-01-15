<?php

namespace mywishlist\views;

use DateTime;
use Exception;
use mywishlist\utils\Selection;
use Slim\Slim;

/**
 * Class ListView, vue qui a pour but de gerais affichage avec tous se qui est en raport avec les list
 * @package mywishlist\views
 */
class ListView
{

    /**
     * @var $list mixed liste d'item, simple item ou autre, a pour but de trenferais des information
     * @var $selecteur string la fonction a appelé pour la generation de la page html
     * @var $content string variable contenant l'html generais
     * @var $app Slim variable contenent un instance de slim
     */
    protected $list, $selecteur, $content, $app;

    /**
     * ItemView constructor.
     * @param $l mixed liste de liste, list simple ou autre, a pour but de trenferais des information
     * @param $s string la fonction a appelé pour la generation de la page html
     */
    public function  __construct($l, $s)
    {
        $this->list = $l;
        $this->selecteur = $s;
        $this->app = Slim::getInstance();
    }

    /**
     * Fonction qui a pour but de generais une partie de l'affichage, dans ce cas affiché des liste
     * @param $array array liste des valeurs a affiché
     * @param bool $edit condition du lien d'accées
     * @return string html genais
     */
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
        foreach ($array as $values)
        {
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

    /**
     * Fonction qui a pour but d'affiché tous les liste que je posséde et que j'ai participé
     * @return string html geneais
     */
    private function displayMyLists()
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

    /**
     * Fonction qui a pour but d'affiché tous les liste public
     * @return string html generais
     */
    private function displayPublicList()
    {
        $res = '<div id="listsByOthers"><h1>listes public</h1>';
        $res .= $this->buildListTable($this->list, false);
        $res .= '</div>';
        return $res;
    }

    /**
     * Fonction qui a pour but de genrais l'affichage des items d'un listes
     * @param $item array liste d'items
     * @param $args array argument d'afficage
     * @return string html genrais
     */
    private function buildItemList($item, $args): string
    {
        $targetDir = "/uploads";
        if (!$args['exp'] && !$args['p']) $out = "<table><tr><th>Image</th><th>Nom</th><th>Statut de la réservation</th>";
        else $out = "<table><tr><th>Image</th><th>Nom</th><th>Réservation par</th><th>Message</th>";
        if (!$args['p']) $out .= '<th>Modifier l\'item</th></tr>';
        else $out .= '<th>Réserver l\'item</th></tr>';

        foreach ($item as $key => $value)
        {
            $url = $this->app->urlFor('manageItemFromList', array('token' => $args['token'], 'item' => $value->id));
            $editable = (!empty($value->nomReserve) || $args['exp']) ? 'disabled' : '';
            if (!$args['exp'] && !$args['p'])
            {
                if (!empty($value->nomReserve)) $resv = "Reservé";
                else $resv = "Non réservé";
                $out .= "<tr><td><img src=\"$targetDir/$value->img\" alt=\"$value->img\" class='img'></td><td>$value->nom</td><td>$resv</td>";
                $out .= "<td><button type='button' onclick=\"window.location.href = '$url';\" value=\"goToCreateList\" $editable>Modifier l'item</button></td>";
                $out .= "</tr>";
            } else {
                $out .= "<tr><td><img src=\"$value->img\" alt=\"$value->img\" class='img'></td><td>$value->nom</td><td>$value->nomReserve</td><td>$value->msgReserve</td>";
                $out .= "<td><button type='button' onclick=\"window.location.href = '$url';\" value=\"goToCreateList\" $editable>Réserver l'item</button></td>";
                $out .= "</tr>";
            }
        }
        return $out . "</table>";
    }

    /**
     * Fonction qui affiche un liste en details
     * @param $modifiable bool les permisstion de l'utilisateurs pour pouvoir adapté l'affichage
     * @return string html generais
     * @throws Exception lié a la date
     */
    private function displayListContent($modifiable)
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
            if ($u['owner'] == true)
            {
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

        if ($modifiable)
        {

            $urlEdit = $this->app->urlFor('listMod', array('token' => $this->list['token']));

            $res .= "<button type=\"button\" onclick=\"window.location.href = '$urlEdit'\" value=\"goToShareList\">Modifier la liste</button>";

            if(empty($tokPart))
            {
                $urlShare = $this->app->urlFor('listShare', array('token' => $this->list['token']));
                $res .= "<button type=\"button\" onclick=\"window.location.href = '$urlShare'\" value=\"goToShareList\">Generé un lien de partage</button>";
            } else {
                $urlShare = $_SERVER['SERVER_NAME'] . $this->app->urlFor('list', array('token' => $this->list['tokenPart']));
                $res .= <<<SHARE
<input type="text" value="$urlShare" id="share">

<div class="tooltip">
    <button type="button" onclick="copy()" onmouseout="copy_post()">
      <span id="tooltip_text">Copier dans le press-papier</span>
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
        if ($modifiable)
        {
            if ($exp >= $now) $array = array('p' => false, 'exp' => false, 'token' => $this->list['token']);
            else $array = array('p' => false, 'exp' => true, 'token' => $this->list['token']);
        } else {
            if ($exp >= $now) $array = array('p' => true, 'exp' => false, 'token' => $this->list['token']);
            else $array = array('p' => true, 'exp' => true, 'token' => $this->list['token']);
        }

        $res .= $this->buildItemList($this->list['items'], $array);

        if ($modifiable && $exp >= $now)
        {
            $url = $this->app->urlFor('listAddItem', array('token' => $this->list['token']));
            $res .= "<button type=\"button\" onclick=\"window.location.href = '$url'\" value=\"goToShareList\">Ajouter un item</button>";
        }

        return $res . "</div>";
    }

    /**
     * Fonction qui affiche le formulaire de creation de liste
     * @return string html generais
     */
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
        <input type="checkbox" name="public" value="oui" id="checkbox" class="css-checkbox"/>
			<label for="checkbox" class="css-label">Rendre le liste publique ? </label><br>
        <button type="submit" name ="valid_create_list" value="valid_f1">Valider</button>
    </form>
</div>
END;
        return $str;
    }

    /**
     * Fonction qui permmette d'affiché le formulaire de modification de liste
     * @return string html genrais
     */
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
        <input type="checkbox" name="public" value="oui" id="checkbox" class="css-checkbox"/>
			<label for="checkbox" class="css-label">Rendre le liste publique ? </label><br>
        <button type="submit" name ="valid_modify_list" value="valid_f1">Valider</button>
    </form>
</div>

END;
    }

    /**
     * Fonction appéle pour faire le rendu
     * @throws Exception lié au exception precadament optenue
     */
    public function render()
    {

        switch ($this->selecteur)
        {
            case Selection::ALL_LIST:
                $this->content = $this->displayMyLists();
                break;
            case Selection::TOKEN_LIST_MODIFIABLE:
                $this->content = $this->displayListContent(true);
                break;
            case Selection::TOKEN_LIST:
                $this->content = $this->displayListContent(false);
                break;
            case Selection::LIST_PUBLIC:
                $this->content = $this->displayPublicList();
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
