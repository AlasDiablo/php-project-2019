<?php


namespace mywishlist\views;


class AccueilView
{

    public function render() {
        GlobalView::Header();
        echo <<<END
<div id="content">
				<div id="content-inner">
				
                     <p><h1>TO-DO : Page d'accueil</h1></p>
					
					<div class="clr"></div>
				</div>
			</div>
END;
        GlobalView::Footer();
    }
}