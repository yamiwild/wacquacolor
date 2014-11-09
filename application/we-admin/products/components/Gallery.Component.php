<?php

class Gallery_Component extends WeModel
{

    /**
     * DeleteImage
     * Exclusão de imagem
     *
     * @param $pg_cod
     * @return mixed
     */
    public function DeleteImage($pg_cod)
    {
        $pg = $this->ImageInfo($pg_cod);

        $sql = "DELETE FROM pr_gallery
                 WHERE PG_COD = :PG_COD";
        $stmt = $this->db->prepare($sql);
        $query = $stmt->execute(array(':PG_COD' => $pg_cod));

        if($query)
        {
            if($stmt->rowCount() > 0)
            {
                $image_path = BASEPATH . 'public' . DS . 'site' . DS . $pg->PR_COD . DS . $pg->PG_IMAGE;
                $thumb_path = BASEPATH . 'public' . DS . 'site' . DS . $pg->PR_COD . DS . $pg->PG_IMAGE_THUMB;

                if(is_file($image_path) && is_file($thumb_path))
                {
                    unlink($image_path);
                    unlink($thumb_path);
                }
            }

            return true;
        }
        return false;
    }

    /**
     * ImageAdd
     * Adicionar Imagem
     *
     * @param $pr_cod
     * @param $name
     * @param $size
     * @param $ext
     * @return bool
     */
    public function ImageAdd($pr_cod, $name, $size, $ext)
    {
        $sql = "INSERT INTO pr_gallery
                   SET PR_COD   = :PR_COD,
                       PG_IMAGE = :PG_IMAGE,
                       PG_SIZE  = :PG_SIZE,
                       PG_EXT   = :PG_EXT,
                       PG_DATE  = :PG_DATE";
        $stmt = $this->db->prepare($sql);
        $query = $stmt->execute(array(':PR_COD' => $pr_cod,
            ':PG_IMAGE'  => $name,
            ':PG_SIZE'  => $size,
            ':PG_EXT'   => $ext,
            ':PG_DATE'  => date('Y-m-d H:i:s')
        ));

        if($query)
        {
            return $this->db->lastInsertId();
        }
        return false;
    }

    /**
     * ThumbAdd
     * Adicionar imagem no formato miniatura
     *
     * @param $pg_cod
     * @param $name
     * @return bool
     */
    public function ThumbAdd($pg_cod, $name)
    {
        $sql = "UPDATE pr_gallery
                   SET PG_IMAGE_THUMB   = :PG_IMAGE_THUMB
                 WHERE PG_COD = :PG_COD";
        $stmt = $this->db->prepare($sql);
        $query = $stmt->execute(array(':PG_IMAGE_THUMB' => $name,
            ':PG_COD'   => $pg_cod
        ));

        if($query)
        {
            return true;
        }
        return false;
    }

    /**
     * ListGalleryProduct
     * Listagem de imagens do produto
     *
     * @param $pr_cod
     * @return mixed
     */
    public function ListGalleryProduct($pr_cod)
    {
        $sql = "SELECT * FROM pr_gallery
                 WHERE PR_COD = :PR_COD";
        $stmt = $this->db->prepare($sql);
        $query = $stmt->execute(array(':PR_COD' => $pr_cod));

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Dados de uma imagem específica
     * @param $pg_cod
     * @return mixed
     */
    public function ImageInfo($pg_cod)
    {
        $sql = "SELECT * FROM pr_gallery
                 WHERE PG_COD = :PG_COD";
        $stmt = $this->db->prepare($sql);
        $query = $stmt->execute(array(':PG_COD' => $pg_cod));

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}