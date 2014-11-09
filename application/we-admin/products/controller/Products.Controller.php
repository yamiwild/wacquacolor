<?php
class Products_Controller extends WeController
{

    /**
     * ------------------------------------------------------------------------------------------
     *
     * PRODUTOS
     *
     * ------------------------------------------------------------------------------------------
     */
    public function index()
    {
        $this->load()->model('Products');

        //Lista de Produtos
        $products = $this->ListProducts();
        //Mensagem
        $msg = $this->get_message();
        //View
        $this->load()->view('products', array(
            'title'     => 'Listagem de Produtos',
            'msg'       => $msg,
            'products'  => $products
        ));
    }

    public function edit()
    {
        $this->load()->model('Products');
        $this->load()->component('Category');
        $this->load()->component('Gallery');

        //Código do Produto
        $pr_cod = get_request('subpage');

        if($_POST)
        {
            $this->ProductSave($_POST, $pr_cod);
        }
        //Lista de Categorias
        $categories = $this->ListCategories();

        //Dados do produto
        $product = $this->ProductData($pr_cod);

        $gallery = $this->ListGalleryProduct((int) $pr_cod);

        //Mensagem
        $msg = $this->get_message();

        $this->load()->view('products/edit/*', array(
            'title'         => 'Editção de Produto',
            'msg'           => $msg,
            'categories'    => $categories,
            'product'       => $product,
            'gallery'       => $gallery
        ));
    }

    public function register()
    {
        $this->load()->model('Products');
        $this->load()->component('Category');

        if($_POST)
        {
            $this->ProductAdd($_POST);
        }
        //Lista de Categorias
        $categories = $this->ListCategories();

        //Mensagem
        $msg = $this->get_message();

        $this->load()->view('products/register', array(
            'title'         => 'Cadastro de Produto',
            'msg'           => $msg,
            'categories'    => $categories
        ));
    }

    /**
     * ------------------------------------------------------------------------------------------
     *
     * Galeria
     *
     * ------------------------------------------------------------------------------------------
     */

    public function gallery()
    {
        if(require_page('products/gallery/delete/*/*'))
        {
            $pg_cod = (int) get_request('content');
            $pr_cod = (int) get_request('action');

            $this->load()->component('Gallery');
            $this->DeleteImage($pg_cod);

            header('Location: ' . base_url() . 'produtcs/edit/' . $pr_cod);
        }
    }


    /**
     * ------------------------------------------------------------------------------------------
     *
     * CATEGORIAS
     *
     * ------------------------------------------------------------------------------------------
     */
    public function categories()
    {
        $this->load()->component('Category');

        $categories = $this->ListCategories();

        //Recupera mensagem gerada
        $msg = $this->get_message();

        //View
        $this->load()->view('products/categories', array(
            'title'         => 'Listagem de Categorias de Produtos',
            'msg'           => $msg,
            'categories'    => $categories
        ));
    }

    public function category()
    {
        if(require_page('products/category/add'))
        {
            $this->load()->component('Category');

            //Verifica se o formulário for submetido
            if($_POST)
            {
                $this->CategoryAdd($_POST);
            }
            //Armazena mensagem gerada
            $msg = $this->get_message();

            $this->load()->view('products/category/add', array(
                'title' => 'Adicionar Categoria de Produtos',
                'msg'   => $msg
            ));
        }
        elseif(require_page('products/category/edit/*'))
        {
            $this->load()->component('Category');

            $pca_cod = get_request('content');

            if($_POST)
            {
                $this->CategorySave($_POST, $pca_cod);
            }

            $category = $this->CategoryData($pca_cod);

            //Mensagens
            $msg = $this->get_message();
            //View
            $this->load()->view('products/category/edit/*', array(
                'title' => 'Edição de Categoria',
                'msg'   => $msg,
                'cat'   => $category
            ));
        }
        elseif(require_page('products/category/delete/*'))
        {
            $this->load()->component('Category');

            //Código para exclusão
            $pca_cod = get_request('content');
            $this->CategoryDelete($pca_cod);
            $categories = $this->ListCategories();

            //Mensagens
            $msg = $this->get_message();

            //View
            $this->load()->view('products/category/delete/*', array(
                'title'         => 'Listagem de Categorias de Produtos',
                'msg'           => $msg,
                'categories'    => $categories
            ));
        }

    }

}

?>