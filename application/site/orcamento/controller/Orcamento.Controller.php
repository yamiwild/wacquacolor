<?php
class Orcamento_Controller extends WeController
{

    public  function index()
    {
        $this->load()->model('Orcamento');

        if($_POST)
        {
            if($this->saveOrder($_POST))
                header('Location: ' . base_url() . 'orcamento/agradecimento');
        }

        //Lista de Produtos
        $products = $this->getProducts();

        //Mensagem
        $msg = $this->get_message();
        //view
        $view = array('products' => $products,
            'title_page'    => 'Orçamento',
            'msg'           => $msg
        );
        $this->load()->view('orcamento', $view);
    }

    public function deletar()
    {
        $this->load()->model('Orcamento');

        if(get_request('subpage'))
        {
            $this->delete(get_request('subpage'));
        }
        header('Location: ' . base_url() . 'orcamento');
    }
}