<?php


namespace mywishlist\views;


interface IView
{
    /**
     * @param string $code code corespondant a l'action / page a affiché
     * @param object $data_set objet corespondant a un objet qui doit etre affiché dans la view(c'est juste une class qui contient des donnée)
     * @return array list contant l'html, le css (via balise html) et le titre de la page
     */
    public function render(string $code, $data_set): array;
}