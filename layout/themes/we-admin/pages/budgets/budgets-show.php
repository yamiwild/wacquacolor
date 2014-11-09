<div class="invoice">
<?php if(isset($client) && isset($products) && isset($budget)): ?>
<div class="row invoice-logo">
    <div class="col-md-6 invoice-logo-space"></div>
    <div class="col-md-6">
        <p>
            #<?=$budget->BU_COD?> / <?= date('d m Y', strtotime($budget->BU_DATETIME)) ?>
        </p>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <h3>Cliente</h3>
        <ul class="list-unstyled">
            <li>
                <?=$client->CLI_NAME?>
            </li>
            <li>
                <?=$client->CLI_CNPJ?>
            </li>
            <li>
                <?=(!empty($client->CLI_EMAIL)) ? $client->CLI_EMAIL : 'Não informado'?>
            </li>
            <li>
                <?=(!empty($client->CLI_TELEFONE)) ? $client->CLI_TELEFONE : 'Não informado'?>
            </li>
            <li>
                <?=(!empty($client->CLI_CONTACT_NAME)) ? $client->CLI_CONTACT_NAME : 'Não informado'?>
            </li>
            <li>
                <?=(!empty($client->CLI_DESCRIPTION)) ? $client->CLI_DESCRIPTION : 'Não informado'?>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="hidden-480">
                    Códugo do Sistema
                </th>
                <th class="hidden-480">
                    Código do Produto
                </th>
                <th>
                    Produto
                </th>
                <th class="hidden-480">
                    Dimensões
                </th>
            </tr>
            </thead>
            <tbody>
            <?php if(count($products) > 0): ?>
            <?php foreach($products as $p): ?>
            <tr>
                <td>
                    <?=$p->PR_COD?>
                </td>
                <td>
                    <?=$p->PR_COD_REF?>
                </td>
                <td class="hidden-480">
                    <?=$p->PR_NAME?>
                </td>
                <td class="hidden-480">
                    <?=$p->PR_DIMENSION?>
                </td>
            </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
</div>