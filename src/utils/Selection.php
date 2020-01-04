<?php


namespace mywishlist\utils;


class Selection
{
    const ALL_LIST = 'ALL_LIST';
    const ID_LIST = 'ID_LIST';
    const FORM_LIST = 'FORM_LIST';
    const SHARE_LIST = 'SHARE_LIST';

    const ALL_ITEM = 'ALL_ITEM';
    const ID_ITEM = 'ID_ITEM';
    const FORM_ITEM = 'FORM_ITEM';
    const FORM_ITEM_RESERVE = 'FORM_ITEM_RESERVE';
    const FORM_ITEM_RESERVE_FAIL = 'FORM_ITEM_RESERVE_FAIL';
    const FORM_ITEM_RESERVE_SUCCESS = 'FORM_ITEM_RESERVE_SUCCESS';

    const ACCOUNT = 'ACCOUNT';
    const REGISTER_POST = 'REGISTER_POST';
    const REGISTER_POST_SUCCESS = 'REGISTER_POST_SUCCESS';
    const REGISTER_POST_FAILED = 'REGISTER_POST_FAILED';
    const REGISTER_POST_USER_OR_EMAIL_EXSITE = 'REGISTER_POST_USER_OR_EMAIL_EXSITE';
    const DATA_FAILED = 'DATA_FAILED';

    const LOGIN_POST = 'LOGIN_POST';
    const LOGIN_POST_SUCCESS = 'LOGIN_SUCCESS';
    const LOGIN_POST_FAILED = 'LOGIN_POST_FAILED';
    const LOGIN_POST_USERPASS_WRONG = "LOGIN_POST_USERPASS_WRONG";

    const LOGOUT = "LOGOUT";
    const CHANGE_FAILD = "CHANGE_FAILD";
    const CHANGE_BAD_PASSWORD = "CHANGE_BAD_PASSWORD";
    const CHANGE_USER_ERROR = "CHANGE_USER_ERROR";
    const CHANGE_USER = "CHANGE_USER";
    const CHANGE_USER_UNAUTHORIZED = "CHANGE_USER_UNAUTHORIZED";
    const ACCOUNT_DELETE = "ACCOUNT_DELETE";
    const CHANGE_OK = "CHANGE_OK";
}