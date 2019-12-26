<?php


namespace mywishlist\utils;
use MyCLabs\Enum\Enum;


class Selection extends Enum
{
    const ALL_LIST = 'ALL_LIST';
    const ID_LIST = 'ID_LIST';
    const FORM = 'FORM';

    const REGISTER = 'REGISTER';
    const REGISTER_POST = 'REGISTER_POST';
    const REGISTER_POST_SUCCESS = 'REGISTER_POST_SUCCESS';
    const REGISTER_POST_FAILED = 'REGISTER_POST_FAILED';
    const REGISTER_POST_USER_OR_EMAIL_EXSITE = 'REGISTER_POST_USER_OR_EMAIL_EXSITE';
    const DATA_FAILED = 'DATA_FAILED';

    const LOGIN = 'LOGIN';
    const LOGIN_POST = 'LOGIN_POST';
    const LOGIN_POST_SUCCESS = 'LOGIN_SUCCESS';
    const LOGIN_POST_FAILED = 'LOGIN_POST_FAILED';
    const LOGIN_POST_USERPASS_WRONG = "LOGIN_POST_USERPASS_WRONG";

    const LOGOUT = "LOGOUT";
}