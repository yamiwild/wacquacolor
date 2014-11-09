<?php

class Produtos_Model extends WeModel
{

    /**
     * ListCategories
     * Lista de categorias
     * @return mixed
     */
    public function ListCategories()
    {
        $sql = "SELECT * FROM pr_category";

        $stmt = $this->db->prepare($sql);
        $query = $stmt->execute();
        if($query)
        {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        $this->set_message('Ow! Algo inesperado aconteceu.', 'error');
    }

    /**
     * CategoryProducts
     * Produtos da categoria
     *
     * @param $category
     * @return null
     */
    public function CategoryProducts($category)
    {
        $sql = "SELECT P.PR_COD,
                       P.PR_COD_REF,
                       P.PR_NAME,
                       C.PCA_NAME
                  FROM pr_product AS P
            INNER JOIN pr_category AS C
                    ON C.PCA_COD = P.PCA_COD
                 WHERE PCA_URL = :PCA_URL";

        $stmt = $this->db->prepare($sql);
        $query = $stmt->execute(array(':PCA_URL' => $category));
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        if($query && $data[0]->PR_COD != null)
        {
            return $data;
        }

        return null;
    }

    /**
     * CartIntes
     * Total de Itens no carrinho de compras
     *
     * @return int
     */
    public function CartIntes()
    {

        if(isset($_COOKIE['acquacolor_cart']))
        {
            $acquacolor_cart = json_decode($_COOKIE['acquacolor_cart']);
            return count($acquacolor_cart);
        }

        return 0;
    }
}
