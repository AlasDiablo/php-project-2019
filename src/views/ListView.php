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

    private function displayAllList()
    {
        $res = "<table><th>no</th><th>user_id</th><th>titre</th><th>description</th><th>expiration</th>";
        foreach ($this->list as $lis)
        {
            $res = <<<CONACT
$res
<tr>
<td>$lis->no</td><td>$lis->user_id</td><td>$lis->titre</td><td>$lis->description</td><td>$lis->expiration</td>
</tr>
CONACT;
        }
        return $res . "</table>";
    }

    private function displayOneList()
    {
        $res = "<table><th>no</th><th>user_id</th><th>titre</th><th>description</th><th>expiration</th>";
        foreach ($this->list as $lis)
        {
            $res = <<<CONACT
$res
<tr>
<td>$lis->no</td><td>$lis->user_id</td><td>$lis->titre</td><td>$lis->description</td><td>$lis->expiration</td>
</tr>
CONACT;
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

    public function render()
    {
        if ($this->selecteur->equals(Selection::ALL_LIST())) $this->content = $this->displayAllList();
        if ($this->selecteur->equals(Selection::ID())) $this->content = $this->displayOneList();
        if ($this->selecteur->equals(Selection::FORM_LIST())) $this->content = $this->formCreateList();

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