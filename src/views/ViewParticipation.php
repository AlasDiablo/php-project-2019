<?php

namespace mywishlist\views;

class ViewParticipation
{
    private $tab;

    public function __construct($tab)
    {
        
    }

    private function drawListeSouhaits()
    {
        $str = "<section>";
        foreach ($tab as $key => $value) {
            $str +=
<<<END
<p>$key : $value</p>
END;
        }
        $str += "</section>";
        return str;
    }

    private function drawItemListe()
    {
        return
<<<END

END;
    }

    private function drawItem()
    {
        return
<<<END

END;
    }

    private function render($type)
    {
        $content = "";
        switch ($type) {
            case 2:
                $content = drawItemListe();
                break;
            case 3:
                $content = drawItem();
                break;
            default:
                $content = drawListeSouhaits();
            break;
        }
        return
<<<END
$content
END;
    }

}