<?php

class Orcamento_Model extends WeModel
{

    /**
     * saveOrder
     * Salva Orçamento
     * @param $post
     */
    public function saveOrder($post)
    {
        if(isset($_COOKIE['acquacolor_cart']))
        {
            $cod_products = json_decode($_COOKIE['acquacolor_cart']);
            if (count($cod_products) > 0)
            {
                $cli_cod = $this->getClient($post['cnpj']);
                if($cli_cod)
                {
                    $sql = "INSERT INTO bu_budget
                               SET CLI_COD = :CLI_COD
                                   BU_DATETIME = :BU_DATETIME";

                    $stmt = $this->db->prepare($sql);
                    $query = $stmt->execute(array(
                        ':CLI_COD' => $cli_cod,
                        ':BU_DATETIME' => date('Y-m-d H:i:s')
                    ));
                    $bu_cod = $this->db->lastInsertId();
                    if($query)
                    {
                        $flag = array();
                        foreach ($cod_products as $cod) {
                            $sql = "INSERT INTO bu_products
                                   SET BU_COD = :BU_COD,
                                       PR_COD = :PR_COD";

                            $stmt = $this->db->prepare($sql);
                            $query = $stmt->execute(array(':BU_COD' => $bu_cod,
                                ':PR_COD' => $cod
                            ));

                            if (!$query)
                                $this->set_message('No momento não estamos realizando orçamentos', 'error');
                            else
                                $flag[] = 't';
                        }
                        if (in_array('t', $flag)) {
                            $this->set_message('O seu orçamento foi enviado com sucesso, em breve nossa equipe entrará em contato.', 'success');
                            setcookie("acquacolor_cart", "", time() - 2592000, '/');
                            return true;
                        }
                    }
                    else
                    {
                        $this->set_message('No momento não estamos realizando orçamentos', 'error');
                    }
                }
                else
                    $this->set_message('Este CNPJ não está cadastrado, só nossos clientes podem realizar orçamentos. Quer se tornar cliente? entre em contato conosco!', 'error');
            }
            else
                $this->set_message('Você não possui nenhum item para realizar um orçamento.', 'error');
        }
        else
            $this->set_message('Você não possui nenhum item para realizar um orçamento.', 'error');
    }

    /**
     * delete
     * Exclusão de produto
     * @param $pr_cod
     */
    public function delete($pr_cod)
    {
        if(isset($_COOKIE['acquacolor_cart']))
        {
            $cod_products = json_decode($_COOKIE['acquacolor_cart']);
            if (count($cod_products) > 0)
            {
                $key = array_search($pr_cod, $cod_products);
                if(isset($cod_products[$key]))
                {
                    unset($cod_products[$key]);
                    $list = json_encode($cod_products);
                    setcookie('acquacolor_cart', $list, strtotime('+30 days'), '/');
                }
            }
        }
    }

    /**
     * getClient
     * Código do cliente
     * @param $cnpj
     * @return null
     */
    private function getClient($cnpj)
    {
        $sql = "SELECT CLI_COD FROM cl_client
                 WHERE CLI_CNPJ = :CLI_CNPJ";
        $stmt = $this->db->prepare($sql);
        $query = $stmt->execute(array(':CLI_CNPJ' => $cnpj));

        if($query && $stmt->rowCount() > 0)
        {
            return $stmt->fetch(PDO::FETCH_OBJ)->CLI_COD;
        }

        return false;
    }

    /**
     * getProducts
     * Produtos armazenado no cookie
     * @return array|null
     */
    public function getProducts()
    {
        if(isset($_COOKIE['acquacolor_cart']))
        {
            $cod_products = json_decode($_COOKIE['acquacolor_cart']);
            if(count($cod_products) > 0)
            {
                $products = array();
                foreach ($cod_products as $cod)
                {
                    $products[] = $this->getDataProduct($cod);
                }
                return $products;
            }
        }

        return  null;
    }

    /**
     * getDataProduct
     * Dados do produto
     * @param $pr_cod
     * @return null
     */
    private function getDataProduct($pr_cod)
    {
        $sql = "SELECT P.*,
                       C.PCA_NAME
                  FROM pr_product AS P
            INNER JOIN pr_category AS C
                    ON C.PCA_COD = P.PCA_COD
                 WHERE PR_COD = :PR_COD";

        $stmt = $this->db->prepare($sql);
        $query = $stmt->execute(array(':PR_COD' => $pr_cod));

        if($query && $stmt->rowCount() > 0)
        {
            return $stmt->fetch(PDO::FETCH_OBJ);;
        }

        return null;
    }
}
