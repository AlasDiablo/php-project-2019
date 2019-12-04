<?php


namespace mywishlist\views;


interface IView
{
    public function render($code, $data_set): string;
}