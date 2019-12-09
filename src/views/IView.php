<?php


namespace mywishlist\views;


interface IView
{
    /**
     * @param $code code corespondant a l'action / page a affiché
     * @param $data_set objet corespondant a un objet qui doit etre affiché dans la view(c'est juste une class qui contient des donnée)
     * @return array list contant l'html, le css (via balise html) et le titre de la page
     */
    public function render($code, $data_set): array;
}