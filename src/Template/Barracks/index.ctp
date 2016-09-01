<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Barrack'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Barrack Users'), ['controller' => 'BarrackUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Barrack User'), ['controller' => 'BarrackUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Operations'), ['controller' => 'Operations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Operation'), ['controller' => 'Operations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="barracks index large-9 medium-8 columns content">
    <h3><?= __('Liste des casernes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name',['label' => 'Nom']) ?></th>
                <th><?= $this->Paginator->sort('address',['label' => 'Adresse']) ?></th>
                <th><?= $this->Paginator->sort('city_id',['label' => 'Ville']) ?></th>
                <th><?= $this->Paginator->sort('phone',['label' => 'Téléphone']) ?></th>
                <th><?= $this->Paginator->sort('fax') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('website_url',['label' => 'URL du site ']) ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barracks as $barrack): ?>
            <tr>
                <td><?= $this->Number->format($barrack->id) ?></td>
                <td><?= h($barrack->name) ?></td>
                <td><?= h($barrack->address) ?></td>
                <td><?= $barrack->has('city') ? $this->Html->link($barrack->city->id, ['controller' => 'Cities', 'action' => 'view', $barrack->city->id]) : '' ?></td>
                <td><?= h($barrack->phone) ?></td>
                <td><?= h($barrack->fax) ?></td>
                <td><?= h($barrack->email) ?></td>
                <td><?= h($barrack->website_url) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Voir'), ['action' => 'view', $barrack->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $barrack->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $barrack->id], ['confirm' => __('Voulez-vous vraiment supprimer la caserne # {0}?', $barrack->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
