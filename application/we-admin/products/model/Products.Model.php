<?php

class Products_Model extends WeModel{


    /**
     * ListProducts
     * Listagem de site
     *
     * @return mixed
     */
    public function ListProducts()
    {
        $sql = "SELECT P.PR_COD,
					 P.PR_COD_REF,
					 P.PR_NAME,
					 C.PCA_NAME,
					 G.G_QTD
			    FROM pr_product AS P
          INNER JOIN pr_category AS C
				  ON C.PCA_COD = P.PCA_COD
           LEFT JOIN (
                      SELECT PR_COD,
                             COUNT(*) AS G_QTD
                        FROM pr_gallery
		            GROUP BY PR_COD
           ) AS G ON G.PR_COD = P.PR_COD";

        $stmt = $this->db->prepare($sql);
        $query = $stmt->execute();

        if($query)
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        $this->set_message('Falha na obtenção dos site.', 'error');
    }

    /**
     * Dados de um produto específico
     *
     * @param $pr_cod
     * @return mixed
     */
    public function ProductData($pr_cod)
    {
        $v = new \Respect\Validation\Validator;

        if($v::numeric()->positive()->validate($pr_cod))
        {
            $sql = "SELECT P.*,
                           C.PCA_COD,
                           COUNT(G.PG_COD) AS G_QTD
                      FROM pr_product AS P
                INNER JOIN pr_category AS C
                        ON C.PCA_COD = P.PCA_COD
                 LEFT JOIN pr_gallery AS G
                        ON G.PR_COD = P.PR_COD
                     WHERE P.PR_COD = :PR_COD";

            $stmt = $this->db->prepare($sql);
            $query = $stmt->execute(array(':PR_COD' => (int) $pr_cod));
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if($query && $stmt->rowCount() > 0 && !is_null($data->PR_COD))
            {
                return $data;
            }
            else
            {
                $this->set_message('Falha na obtenção de dados do produto', 'error');
            }
        }
        else
        {
            $this->set_message('Código do produto é inválido.', 'error');
        }
    }



    /**
     * ProductAdd
     * Cadastro de Categoria
     *
     * @param $post
     * @return void
     */
    public function ProductAdd($post)
    {

        $v = new \Respect\Validation\Validator;

        $validation = $v::key('pca_cod', $v::numeric()->positive())
                        ->key('pr_name', $v::string()->notEmpty())
                        ->key('pr_cod_ref', $v::string()->notEmpty());

        if($validation->validate($post))
        {
            if($this->CheckCategory((int) $post['pca_cod']))
            {
                //Limpando post
                foreach($post as $k => $v)
                    if(empty($v))
                        $post[$k] = null;

                $this->db->beginTransaction();

                $sql = "INSERT INTO pr_product
                           SET PCA_COD        = :PCA_COD,
                               PR_NAME        = :PR_NAME,
                               PR_COD_REF     = :PR_COD_REF,
                               PR_DIMENSION   = :PR_DIMENSION,
                               PR_DESCRIPTION = :PR_DESCRIPTION,
                               PR_DATE        = :PR_DATE";

                $stmt = $this->db->prepare($sql);
                $query = $stmt->execute(array(':PCA_COD' => (int) $post['pca_cod'],
                    ':PR_NAME'          => htmlspecialchars($post['pr_name']),
                    ':PR_COD_REF'       => htmlspecialchars($post['pr_cod_ref']),
                    ':PR_DIMENSION'     => htmlspecialchars($post['pr_dimension']),
                    ':PR_DESCRIPTION'   => htmlspecialchars($post['pr_description']),
                    ':PR_DATE'          => date('Y-m-d H:i:s'),
                ));

                if($query)
                {
                    //Upload de imagem e registro da galeria
                    if($this->CheckFilesUpload($_FILES['pg_image']) === true)
                    {
                        $pr_cod = $this->db->lastInsertId();
                        $path = BASEPATH . 'public' . DS . 'products' . DS . $pr_cod;
                        if(mkdir($path, 777))
                        {
                            if($this->Upload($_FILES['pg_image'], $path, $pr_cod) === true)
                            {
                                $this->db->commit();
                                $this->set_message('O produto <b>' . $post['pr_name'] . '</b> foi adicionado.', 'success');
                            }
                            else
                            {
                                $this->db->rollBack();
                                $this->set_message('Falha ao fazer upload das imagens', 'error');
                            }
                        }
                        else
                        {
                            $this->db->rollBack();
                            $this->set_message('Falha ao cirar diretório para alocar imagens', 'error');
                        }
                    }
                    $this->set_message('O produto <b>' . $post['pr_name'] . '</b> foi adiciondo.', 'success');
                }
                else
                {
                    $this->set_message('Falha ao inserir o produto ' . $post['pr_name'] . '.', 'error');
                }
            }
            else
            {
                $this->set_message('Categoria Inválida', 'error');
            }
        }
        else
        {
            $this->set_message('Preencha os campos corretamente', 'error');
        }
	}

    /**
     * ProductSave
     * Cadastro de Categoria
     *
     * @param $post
     * @param $pr_cod
     * @return void
     */
    public function ProductSave($post, $pr_cod)
    {

        $v = new \Respect\Validation\Validator;

        $validation = $v::key('pca_cod', $v::numeric()->positive())
            ->key('pr_name', $v::string()->notEmpty())
            ->key('pr_cod_ref', $v::string()->notEmpty());

        if($validation->validate($post) && $v::numeric()->positive()->validate($pr_cod))
        {
            if($this->CheckCategory((int) $post['pca_cod']))
            {
                //Limpando post
                foreach($post as $k => $v)
                    if(empty($v))
                        $post[$k] = null;

                $this->db->beginTransaction();

                $sql = "UPDATE pr_product
                           SET PCA_COD        = :PCA_COD,
                               PR_NAME        = :PR_NAME,
                               PR_COD_REF     = :PR_COD_REF,
                               PR_DIMENSION   = :PR_DIMENSION,
                               PR_DESCRIPTION = :PR_DESCRIPTION,
                               PR_DATE        = :PR_DATE
                         WHERE PR_COD         = :PR_COD";

                $stmt = $this->db->prepare($sql);
                $query = $stmt->execute(array(':PCA_COD' => (int) $post['pca_cod'],
                    ':PR_NAME'          => htmlspecialchars($post['pr_name']),
                    ':PR_COD_REF'       => htmlspecialchars($post['pr_cod_ref']),
                    ':PR_DIMENSION'     => htmlspecialchars($post['pr_dimension']),
                    ':PR_DESCRIPTION'   => htmlspecialchars($post['pr_description']),
                    ':PR_DATE'          => date('Y-m-d H:i:s'),
                    ':PR_COD'           => (int) $pr_cod
                ));

                if($query)
                {
                    //Upload de imagem e registro da galeria
                    if($this->CheckFilesUpload($_FILES['pg_image']) === true)
                    {
                        $path = BASEPATH . 'public' . DS . 'site' . DS . $pr_cod;

                        if($this->Upload($_FILES['pg_image'], $path, $pr_cod) === true)
                        {
                            $this->db->commit();
                            $this->set_message('O produto <b>' . $post['pr_name'] . '</b> foi adicionado.', 'success');
                        }
                        else
                        {
                            $this->db->rollBack();
                            $this->set_message('Falha ao fazer upload das imagens', 'error');
                        }
                    }
                    $this->set_message('O produto <b>' . $post['pr_name'] . '</b> foi alterado.', 'success');
                }
                else
                {
                    $this->set_message('Falha ao atualizar o produto ' . $post['pr_name'] . '.', 'error');
                }
            }
            else
            {
                $this->set_message('Categoria Inválida', 'error');
            }
        }
        else
        {
            $this->set_message('Preencha os campos corretamente', 'error');
        }
    }

    /**
     * Verifica arquivos para upload
     * @param $files
     * @return bool
     */
    private function CheckFilesUpload($files)
    {
        foreach($files['error'] as $k => $error)
        {
            switch($error)
            {
                case UPLOAD_ERR_OK:
                   return true;
                case UPLOAD_ERR_NO_FILE:
                    return 'Nenhum arquivo selecionado.';
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    return 'Limite de tamanho dos arquivos excedidos.';
                default:
                    return 'Não é possível ennviar arquivos no momento. Causa desconhecida.';
            }
        }
    }

    /**
     * Upload
     * Upload de imagens
     *
     * @param $files_upload
     * @param $path_dir
     * @param $pr_cod
     * @return bool
     */
    private function Upload($files_upload, $path_dir, $pr_cod)
    {
        //Incluindo classe responsável pelo upload
        $file =  BASEPATH . 'engine' . DS . 'helpers' . DS . 'upload' . DS . 'class.upload.php';
        if(is_file($file))
        {
            include_once $file;

            $files = array();
            foreach ($files_upload as $k => $l)
            {
                foreach ($l as $i => $v)
                {
                    if (!array_key_exists($i, $files))
                        $files[$i] = array();
                    $files[$i][$k] = $v;
                }
            }

            /*
             * Upload de Arquivos
             */
            foreach($files as $file)
            {
                $ioriginal = new Upload($file);
                $ithumb = new Upload($file);

                $ioriginal_status = $this->UploadOriginalImage($ioriginal, $path_dir);
                $ithumb_status = $this->UploadThumbImage($ithumb, $path_dir);

                //Componente Gallery
                $component = __DIR__ . DS . '..' . DS . 'components' . DS . 'Gallery.Component.php';
                include_once $component;
                $gallery = new Gallery_Component();

                $pg_cod = null;
                if($ioriginal_status !== true)
                    return $ioriginal_status;
                else
                {
                    $pg_cod = $gallery->ImageAdd($pr_cod, $ioriginal->file_dst_name, $ioriginal->file_src_size, $ioriginal->file_dst_name_ext);
                    if($pg_cod === false)
                        return false;
                }

                if($ithumb_status !== true)
                    return $ithumb_status;
                else
                {
                    if(isset($pg_cod))
                    {
                        if($gallery->ThumbAdd($pg_cod, $ithumb->file_dst_name) === false)
                            return false;
                    }
                }

                $ioriginal->clean();
                $ithumb->clean();
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * UploadOriginalImage
     * Upload de imagens em formato orginal - modificado
     * @param Upload $upload
     * @param $path_dir
     * @return bool|string
     */
    private function UploadOriginalImage(Upload $upload, $path_dir)
    {
        $upload->allowed = array('image/*');
        if ($upload->uploaded) {
            $upload->file_name_body_add = '_original';
            $upload->image_resize         = true;
            $upload->image_x              = 600;
            $upload->image_ratio_y        = true;
            $upload->process($path_dir);
            if ($upload->processed) {
                return true;
            } else {
                return  $upload->error;
            }
        }
        return false;
    }

    /**
     * UploadThumbImage
     * Upload de imagem em tamanho miniatura
     *
     * @param Upload $upload
     * @param $path_dir
     * @return bool|string
     */
    private function UploadThumbImage(Upload $upload, $path_dir)
    {
        $upload->allowed = array('image/*');
        if ($upload->uploaded) {
            $upload->file_name_body_add = '_thumb';
            $upload->image_resize         = true;
            $upload->image_x              = 170;
            $upload->image_y              = 111;
            $upload->image_ratio_y        = true;
            $upload->image_ratio_x        = true;
            $upload->process($path_dir);
            if ($upload->processed) {
                return true;
            } else {
                return  $upload->error;
            }
        }
        return false;
    }


    /**
     * CheckCategory
     * Verifica se a categoria existe
     *
     * @param $pca_cod
     * @return bool
     */
    private function CheckCategory($pca_cod)
    {
        $sql = "SELECT COUNT(*) AS TOTAL FROM pr_category
                 WHERE PCA_COD = :PCA_COD";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':PCA_COD' => $pca_cod));

        if($stmt->fetch(PDO::FETCH_OBJ)->TOTAL > 0)
            return true;
        return false;
    }
}
