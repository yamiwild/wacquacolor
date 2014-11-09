<?php

class Budgets_Model extends WeModel
{

    public function getListBudgets()
    {
        $sql = "SELECT * FROM bu_budget AS B
            INNER JOIN cl_client AS C
                    ON B.CLI_COD = C.CLI_COD
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function ClientInfo($cli_cod)
    {
        $sql = "SELECT * FROM cl_client WHERE CLI_COD = :CLI_COD";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':CLI_COD' => $cli_cod));

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function ProductsInfo($bu_cod)
    {
        $sql = "SELECT * FROM pr_product AS P
            INNER JOIN bu_products AS B
                    ON B.PR_COD = P.PR_COD
                 WHERE B.BU_COD = :BU_COD";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':BU_COD' => $bu_cod));

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function BudgetInfo($bu_cod)
    {
        $sql = "SELECT * FROM bu_budget
                 WHERE BU_COD = :BU_COD";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':BU_COD' => $bu_cod));

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
