<?php


namespace mywishlist\views;


use mywishlist\utils\Registries;

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
            $res = $res . "<tr>";
            $res = $res . "<td>" . $i->id . "</td><td>" . $i->liste_id . "</td><td>" . $i->nom . "</td><td>" . $i->descr . "</td><td>" . $i->tarif . "</td>";
            $res = $res . "<tr>";
        }
        $res = $res . "</table>";
        return $res;
    }

    private function htmlIdList() {
        return $this->item;
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
            default:
            {
                $content = "Switch Constant Error";
                break;
            }
        }

        GlobalView::Header();
        echo <<<END
<div id="content">
				<div id="content-inner">
				
                     $content;
					
				</div>
			</div>
END;
        GlobalView::Footer();
    }
}