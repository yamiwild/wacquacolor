<?php
class Produtos_Controller extends WeController
{

    public function index()
    {
        $this->load()->model('Produtos');
        $categories = $this->ListCategories();
        $cart_itens = $this->CartIntes();
        //Mensagem
        $msg = $this->get_message();
        //View
        $this->load()->view('produtos', array(
            'categories' => $categories,
            'msg'   => $msg,
            'cart_itens'     => $cart_itens
        ));
    }

    public function categoria()
    {
        $category = get_request('subpage');

        //Model
        $this->load()->model('Produtos');
        $products = $this->CategoryProducts($category);
        $categories = $this->ListCategories();
        $cart_itens = $this->CartIntes();

        $this->load()->view('produtos/categoria/*', array(
            'products'      => $products,
            'categories'    => $categories,
            'cart_itens'     => $cart_itens
        ));
    }
}