<?php
class Clients_Controller extends WeController
{

    public function index()
    {
        $this->load()->model('Clients');
        $clients = $this->getListClients();
        $this->load()->view('clients', array(
            'title'     => "Listagem de Clientes",
            'clients'   => $clients
        ));
    }

    public function register()
    {
        $this->load()->model('Clients');
        if($_POST)
        {
            $this->ClientAdd($_POST);
        }
        $msg = $this->get_message();
        $this->load()->view('clients/register', array(
            'title' => "Cadastro de Cliente",
            'msg'   => $msg
        ));
    }

    public function edit()
    {
        $this->load()->model('Clients');

        $client = null;
        $cli_cod = get_request('subpage');
        if($cli_cod !== false)
        {
            if($_POST)
            {
                $this->ClientEdit($_POST, $cli_cod);
            }
            $client = $this->getClientData((int) get_request('subpage'));
        }

        //Mensagem
        $msg = $this->get_message();

        $this->load()->view('clients/edit/*', array(
            'msg' => $msg,
            'client' => $client
        ));
    }

    public function delete()
    {
        $this->load()->model('Clients');

        $client = null;
        $cli_cod = get_request('subpage');
        if($cli_cod !== false)
        {
            $this->ClientRemove((int) get_request('subpage'));
        }
        $clients = $this->getListClients();

        //Mensagem
        $msg = $this->get_message();

        $this->load()->view('clients/delete/*', array(
            'title' => 'Listagem de Clientes',
            'msg' => $msg,
            'clients' => $clients
        ));
    }

}