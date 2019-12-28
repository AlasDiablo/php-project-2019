<?php

namespace mywishlist\views;

class ItemView
{

    const ALL_ITEM = 'ALL_ITEM';
    const ID_ITEM = 'ID_ITEM';
    const FORM = 'FORM';

    protected $item, $selecteur;

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

    private function htmlReserve()
    {
        $id=filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $str = 
<<<END
<form action="/index.php/item/reserve/submit/" method="POST">
Item:$id<br>
<input name = 'id_reserve_item' value=$id><br>
Nom:
<input type="text" name="nom_reserve_item"><br>
<input type="submit" name="valider">
</form>

END;
        return $str;
    }

    public function render()
    {
        switch ($this->selecteur) {
            case self::ALL_ITEM:
            {
                $content = $this->htmlAllItem();
                break;
            }
            case self::ID_ITEM:
            {
                $content = $this->htmlIdList();
                break;
            }
            case self::FORM:
            {
                $content = $this->htmlReserve();
                break;
            }
            default:
            {
                $content = "Switch Constant Error";
                break;
            }
        }
        $body = <<<END
<div id="content">
    <div id="content-inner">
         $content;
    </div>
</div>
END;
        ViewRendering::render($body);
    }
}