<?php
class Budgets_Controller extends WeController
{
    public function __construct()
    {
        $this->load()->model('Budgets');
    }

    public function index()
    {
        $budgets = $this->getListBudgets();

        $this->load()->view('budgets', array(
            'title'     => 'Orçamentos',
            'budgets'   => $budgets
        ));
    }

    public function show()
    {
        $bu_cod = get_request('subpage');
        if($bu_cod !== false)
        {
            $budget = $this->BudgetInfo($bu_cod);
            $client = $this->ClientInfo($budget->CLI_COD);
            $products = $this->ProductsInfo($bu_cod);

            $this->load()->view('budgets/show/*', array(
                'title' => 'Orçamento',
                'client' => $client,
                'products' => $products,
                'budget' => $budget
            ));
        }
    }

}