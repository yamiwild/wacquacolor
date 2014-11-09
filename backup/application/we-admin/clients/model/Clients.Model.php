<?php
class Clients_Model extends WeModel
{

    public function ClientAdd($post)
    {
        $v = new \Respect\Validation\Validator;

        $validation = $v::key('cli_name', $v::string()->notEmpty())
                        ->key('cli_cnpj', $v::string()->notEmpty());

        if($validation->validate($post))
        {
            //Limpando post
            foreach($post as $k => $v)
                if(empty($v))
                    $post[$k] = null;

            $sql = "INSERT INTO cl_client
                       SET CLI_NAME = :CLI_NAME,
                           CLI_CNPJ = :CLI_CNPJ,
                           CLI_DATETIME = :CLI_DATETIME,
                           CLI_EMAIL = :CLI_EMAIL,
                           CLI_TELEFONE = :CLI_TELEFONE,
                           CLI_CONTACT_NAME = :CLI_CONTACT_NAME,
                           CLI_DESCRIPTION = :CLI_DESCRIPTION";
            $stmt = $this->db->prepare($sql);
            $query = $stmt->execute(array(
                ':CLI_NAME' => $post['cli_name'],
                ':CLI_CNPJ' => $post['cli_cnpj'],
                ':CLI_EMAIL' => $post['cli_email'],
                ':CLI_DATETIME' => date('Y-m-d H:i:s'),
                ':CLI_TELEFONE' => $post['cli_telefone'],
                ':CLI_CONTACT_NAME' => $post['cli_contact_name'],
                ':CLI_DESCRIPTION' => $post['cli_description']
            ));

            if($query)
            {
                $this->set_message('Cadastro realizado', 'success');
            }
            else
            {
                $this->set_message('Falha ao inserir cliente', 'error');
            }
        }
        else
        {
            $this->set_message('Preencha os campos corretamente', 'error');
        }
    }


    public function ClientEdit($post, $cli_cod)
    {
        $v = new \Respect\Validation\Validator;

        $validation = $v::key('cli_name', $v::string()->notEmpty())
                        ->key('cli_cnpj', $v::string()->notEmpty());

        if($validation->validate($post))
        {
            //Limpando post
            foreach($post as $k => $v)
                if(empty($v))
                    $post[$k] = null;

            $sql = "UPDATE cl_client
                       SET CLI_NAME = :CLI_NAME,
                           CLI_CNPJ = :CLI_CNPJ,
                           CLI_DATETIME = :CLI_DATETIME,
                           CLI_EMAIL = :CLI_EMAIL,
                           CLI_TELEFONE = :CLI_TELEFONE,
                           CLI_CONTACT_NAME = :CLI_CONTACT_NAME,
                           CLI_DESCRIPTION = :CLI_DESCRIPTION
                     WHERE CLI_COD = :CLI_COD";
            $stmt = $this->db->prepare($sql);
            $query = $stmt->execute(array(
                ':CLI_NAME' => $post['cli_name'],
                ':CLI_CNPJ' => $post['cli_cnpj'],
                ':CLI_EMAIL' => $post['cli_email'],
                ':CLI_DATETIME' => date('Y-m-d H:i:s'),
                ':CLI_TELEFONE' => $post['cli_telefone'],
                ':CLI_CONTACT_NAME' => $post['cli_contact_name'],
                ':CLI_DESCRIPTION' => $post['cli_description'],
                ':CLI_COD' => $cli_cod
            ));

            if($query)
            {
                $this->set_message('Cliente modificado', 'success');
            }
            else
            {
                $this->set_message('Falha ao modificar cliente', 'error');
            }
        }
        else
        {
            $this->set_message('Preencha os campos corretamente', 'error');
        }
    }


    public function ClientRemove($cli_cod)
    {
        $v = new \Respect\Validation\Validator;

        $validation = $v::numeric()->int()->positive()->validate((int)$cli_cod);

        if($validation)
        {
            $this->db->beginTransaction();

            if($this->DeleteBudgets($cli_cod))
            {
                $sql = "DELETE FROM cl_client
                         WHERE CLI_COD = :CLI_COD";
                $stmt = $this->db->prepare($sql);
                $query = $stmt->execute(array(
                    ':CLI_COD' => $cli_cod
                ));

                if ($query) {
                    if ($stmt->rowCount() > 0)
                    {
                        $this->set_message('Cadastro removido', 'success');
                        $this->db->commit();
                    }
                } else {
                    $this->set_message('Falha ao remover cliente', 'error');
                    $this->db->rollBack();
                }
            }
            else
            {
                $this->set_message('Falha ao remover cliente', 'error');
            }
        }
        else
        {
            $this->set_message('Código de cliente inválido', 'error');
        }
    }


    public function getListClients()
    {
        $sql = "SELECT * FROM cl_client";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getClientData($cli_cod)
    {
        $sql = "SELECT * FROM cl_client WHERE CLI_COD = :CLI_COD";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':CLI_COD' => $cli_cod));

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    private function DeleteBudgets($cli_cod)
    {
        $sql = "DELETE FROM bu_budget WHERE CLI_COD = :CLI_COD";
        $stmt = $this->db->prepare($sql);
        $query = $stmt->execute(array(':CLI_COD' => $cli_cod));

        return $query;
    }
}