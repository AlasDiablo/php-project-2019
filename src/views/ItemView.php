<?php

namespace mywishlist\views;

use mywishlist\models\Item;
use mywishlist\utils\Authentication;
use mywishlist\utils\Selection;

class ItemView
{

    protected $item, $selecteur, $content;

    public function __construct($i, $s)
    {
        $this->item = $i;
        $this->selecteur = $s;
    }

    private function htmlAllItem() {
        $res = "<table><th>ID</th><th>liste_ID</th><th>nom</th><th>description</th><th>tarif</th>";
        foreach ($this->item as $i)
        {
            $res = <<<RES
$res
<tr>
<td>$i->id</td><td>$i->liste_id</td><td>$i->nom</td><td>$i->descr</td><td>$i->tarif</td>
</tr>
RES;
        }
        return $res . "</table>";
    }

    private function htmlIdList() {
        echo getcwd() . "/uploads/";
        $res = "<table><th>ID</th><th>liste_ID</th><th>nom</th><th>description</th><th>tarif</th><th>Réservé par</th><th>Message de réservation</th>";
        foreach ($this->item as $i)
        {
            $res = <<<RES
$res
<tr>
<td>$i->id</td><td>$i->liste_id</td><td>$i->nom</td><td>$i->descr</td><td>$i->tarif</td><td>$i->nomReserve</td><td>$i->msgReserve</td>
</tr>
RES;
        }
        $res .= <<<RES
<table>
<form action="/index.php/item/upload/submit/$i->id" method="POST" enctype="multipart/form-data">
Upload d'une image pour l'item : <input type="file" name="image">
<input type="submit" name ="Uploader">
</form><br>
RES;

        $p = Item::select('nomReserve', 'msgReserve')->where('id', 'like', $i->id)->first();
        // $id=filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        if($p->nomReserve == '' and $p->msgReserve == '' and Authentication::getUserId() != 0) {
            return $res .= <<<END
<form action="/index.php/item/reserve/submit/$i->id" method="POST" enctype="multipart/form-data">
Réservation l'item :<br>
Message de réservation : <input type="text" name="nom_reserve_item"><br>
<input type="submit" name="valider">
</form>
END;
        } else {
            return $res . "</table>";
        }
    }

/*    private function htmlReserve()
    {
        $id=filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $str = 
<<<END
<form action="/index.php/item/reserve/submit?id=$id" method="POST">
Item:$id<br>
<input name = 'id_reserve_item' value=$id readonly="readonly"><br>
Nom:
<input type="text" name="nom_reserve_item"><br>
<input type="submit" name="valider">
</form>
END;
        return $str;
    }*/

    private function htmlFail()
    {
        $str = <<<END
<p> Une erreur est survenu, vérifiez que l'item n'est pas déjà réservé.</p>
END;

        return $str;
    }

    private function htmlSuccess()
    {
        $str = <<<END
<p> Item réservé avec succès !</p>
END;

        return $str;
    }

    private function htmlUploadImageSuccess()
    {
        $str = <<<END
<p>Image upload avec succès</p>
END;
        return $str;

    }

    private function htmlUploadImageError()
    {
        $str = <<<END
<p>Une erreur a eu lieu lors de l'upload de l'image</p>
END;
        return $str;

    }

    private function htmlCreate(){
        $id = $this->item->liste_id;
        $str =
            <<<END
<div id="edit">
    <h1>Creation d'un item</h1>
    <form id="formCreateItem" method="POST" action="/index.php/list/$id/addItem/submit">
        <input type="text" name="nom" placeholder="Nom de l'item" required>
        <input type="text" name="description" placeholder="Description de l'item" required>
        <input type="number" step="0.01" name="prix" placeholder="Prix de l'item" required>
        <input type="url" name="url" placeholder="Lien site marchand">
        <button type="submit" name ="valid_create_item" value="valid_f1">Valider</button>
    </form>
</div>
END;
        return $str;
    }

    private function htmlModify(){
        $no = $this->item[0]['liste_id'];
        $id = $this->item[0]['id'];
        $str =
            <<<END
<form id="formModifyItem" method="POST" action="/index.php/list/$no/item/$id/modify/submit">
<input type="text" name="nom" placeholder="Nom de l'item">
<input type="text" name="description" placeholder="Description de l'item">
<input type="number" step="0.01" name="prix" placeholder="Prix de l'item">
<input type="url" name="url" placeholder="Lien site marchand">
<button type="submit" name ="valid_modify_item" value="valid_f1">Valider</button>
</form>
END;
        return $str;
    }

    public function render()
    {
        switch ($this->selecteur) {
            case Selection::FORM_CREATE_ITEM:
                $this->content = $this->htmlCreate();
                break;
            case Selection::FORM_MODIFY_ITEM:
                $this->content = $this->htmlModify();
                break;
            case Selection::ALL_ITEM:
                $this->content = $this->htmlAllItem();
                break;
            case Selection::ID_ITEM:
                $this->content = $this->htmlIdList();
                break;
            case Selection::FORM_ITEM_RESERVE:
                $this->content = $this->htmlReserve();
                break;
            case Selection::FORM_ITEM_RESERVE_FAIL:
                $this->content = $this->htmlFail();
                break;
            case Selection::FORM_ITEM_RESERVE_SUCCESS:
                $this->content = $this->htmlSuccess();
                break;
            case Selection::FORM_IMAGE_UPLOAD_FAIL:
                $this->content = $this->htmlUploadImageError();
                break;
            case Selection::FORM_IMAGE_UPLOAD_SUCCESS:
                $this->content = $this->htmlUploadImageSuccess();
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