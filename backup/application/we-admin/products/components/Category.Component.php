<?php
class Category_Component extends WeModel
{

    /**
     * ListCategories
     * Listagem de Categorias
     *
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
     * Category
     * Dados de uma categoria específica
     *
     * @param $pca_cod
     * @return mixed[
     */
    public function CategoryData($pca_cod)
    {
        $v = new \Respect\Validation\Validator;

        $validation = $v::numeric()->positive()->validate($pca_cod);

        if($validation)
        {
            $sql = "SELECT * FROM pr_category
                     WHERE PCA_COD = :PCA_COD";

            $stmt = $this->db->prepare($sql);
            $query = $stmt->execute(array(':PCA_COD' => (int) $pca_cod));
            if($query)
            {
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            $this->set_message('Ow! Algo inesperado aconteceu.', 'error');
        }
        else
        {
            $this->set_message('Categoria inválida.', 'error');
        }
    }

    /**
     * CategorySave
     * Edição de categoria
     *
     * @param $post
     * @param $pca_cod
     */
    public function CategorySave($post, $pca_cod)
    {
        $v = new \Respect\Validation\Validator;

        $validation = $v::numeric()->positive()->validate($pca_cod);

        if($validation)
        {
            $sql = "UPDATE pr_category
                       SET PCA_NAME = :PCA_NAME,
                           PCA_URL  = :PCA_URL
                     WHERE PCA_COD = :PCA_COD";
            $stmt = $this->db->prepare($sql);
            $query = $stmt->execute(array(
               ':PCA_NAME'  => $post['pca_name'],
               ':PCA_URL'   => pretty_url(trim($post['pca_name'])),
               ':PCA_COD'   => (int) $pca_cod
            ));

            if($query)
            {
                $this->set_message('Categoria ' . $post['pca_name'] . ' alterada', 'success');
            }
            else
            {
                $this->set_message('Ow! Algo inesperado aconteceu.', 'error');
            }
        }
        else
        {
            $this->set_message('Categoria inválida.', 'error');
        }
    }

    public function CategoryDelete($pca_cod)
    {
        $v = new \Respect\Validation\Validator;

        $validation = $v::numeric()->positive()->validate($pca_cod);

        if($validation)
        {
            $this->db->beginTransaction();

            //Deleta todos os site
            $sqlp = "DELETE FROM pr_product
                     WHERE PCA_COD = :PCA_COD";
            $stmtp = $this->db->prepare($sqlp);
            $queryp = $stmtp->execute(array(':PCA_COD'   => (int) $pca_cod));

            //Deleta categoria
            $sql = "DELETE FROM pr_category
                     WHERE PCA_COD = :PCA_COD";
            $stmt = $this->db->prepare($sql);
            $query = $stmt->execute(array(':PCA_COD'   => (int) $pca_cod));

            if($query && $queryp)
            {
                $this->db->commit();
                if($stmt->rowCount() > 0)
                    $this->set_message('Categoria  excluída', 'success');
            }
            else
            {
                $this->db->rollBack();
                $this->set_message('Ow! falha ao excluir categoria.', 'error');
            }
        }
        else
        {
            $this->set_message('Categoria inválida.', 'error');
        }
    }

    /**
     * CategoryAdd
     * Cadastro de Categoria
     *
     * @param $post
     * @return void
     */
    public function CategoryAdd($post)
    {
        $v = new \Respect\Validation\Validator;

        $validation = $v::key('pca_name', $v::string()->notEmpty());

        if($validation->validate($_POST))
        {
            $sql = "INSERT INTO pr_category
                       SET PCA_NAME = :PCA_NAME,
                           PCA_URL  = :PCA_URL";

            $stmt = $this->db->prepare($sql);
            $query = $stmt->execute(array(':PCA_NAME' => $post['pca_name'],
                ':PCA_URL'   => pretty_url(trim($post['pca_name']))
            ));

            if($query)
            {
                $this->set_message('A categoria <b>' . $post['pca_name'] . '</b> foi adicionada.', 'success');
            }
            else
            {
                $this->set_message('Falha ao inserir a  categoria ' . $post['pca_name'] . '.', 'error');
            }
        }
        else
        {
            $this->set_message('Preencha os campos corretamente', 'error');
        }
    }
}