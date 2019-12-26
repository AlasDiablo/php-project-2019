<?php


namespace mywishlist\views;


use mywishlist\utils\Registries;
use mywishlist\utils\Selection;
use function Composer\Autoload\includeFile;

class ListView
{

    protected $list, $selecteur, $content;


    public function  __construct($l, Selection $s)
    {
        $this->list = $l;
        $this->selecteur = $s;
    }

    private function htmlAllList()
    {
        $res = "<table><th>no</th><th>user_id</th><th>titre</th><th>description</th><th>expiration</th>";
        foreach ($this->list as $lis)
        {
            $res = $res . "<tr>";
            $res = $res . "<td>" . $lis->no . "</td><td>" . $lis->user_id . "</td><td>" . $lis->titre . "</td><td>" . $lis->description . "</td><td>" . $lis->expiration . "</td>";
            $res = $res . "<tr>";
        }
        $res = $res . "</table>";
        return $res;
    }

    private function htmlIdList()
    {
        return $this->list;
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

    public function render()
    {
        if ($this->selecteur->equals(Selection::ALL_LIST())) $this->content = $this->htmlAllList();
        if ($this->selecteur->equals(Selection::ID_LIST())) $this->content = $this->htmlIdList();
        if ($this->selecteur->equals(Selection::FORM())) $this->content = $this->formCreateList();

/*        switch ($this->selecteur)
        {
            case S::ALL_LIST: {
                $content = $this->htmlAllList();
                break;
            }
            case self::ID_LIST: {
                $content = $this->htmlIdList();
                break;
            }
            case self::FORM: {
                $content = $this->formCreateList();
                break;
            }
            default: {
                $content = "Switch Constant Error";
                break;
            }
        }*/

        GlobalView::Header();
         echo <<<END
<div id="content">
				<div id="content-inner">
				
                     $this->content;
					
				</div>
			</div>
END;
        GlobalView::Footer();

    }


/*    public function render($code, $data_set): array{
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
    }*/

}