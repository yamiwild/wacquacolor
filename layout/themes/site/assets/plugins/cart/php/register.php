<?php
if($_POST && isset($_POST['action']))
{
    //Ação
    $action = $_POST['action'];

    if ($action == 'register' && isset($_POST['cod']))
    {
        echo register($_POST['cod']);
    }
}

/**
 * -----------------------------------------------------------
 *  Funções
 * -----------------------------------------------------------
 */
/*
 * Adicionar produto
 */
function register($cod)
{
    $data = array();
    $data['error_msg'] = 0;
    if(isset($_COOKIE['acquacolor_cart']))
    {
        $list = json_decode($_COOKIE['acquacolor_cart']);
        if(!in_array($cod, $list))
        {
            $list[] = $cod;
            setcookie('acquacolor_cart', json_encode($list), strtotime('+30 days'), '/');
        }
        else
        {
            $data['error_msg'] = 'Este produto já se encontra na sua lista';
        }
    }
    else
    {
        setcookie('acquacolor_cart', json_encode(array($cod)), strtotime( '+30 days' ), '/');
    }

    $data['itens'] = cartItens();
    return json_encode($data);
}

function cartItens()
{
    if(isset($_COOKIE['acquacolor_cart']) && count(json_decode($_COOKIE['acquacolor_cart'])) > 0)
            return count(json_decode($_COOKIE['acquacolor_cart'])) + 1;
    else
        return 1;

}