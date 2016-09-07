<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
      <span class="glyphicon glyphicon-envelope">
      </span>
            &nbsp;
            <span id="genre">Boîte de réception</span>
            <!--<div class="dropdown panel-right">-->
            <!--<button class="btn btn-success"-->
            <!--id="selectButton"-->
            <!--data-toggle="dropdown">-->
            <!--Tri&nbsp;-->
            <!--<span class="caret"></span>-->
            <!--</button>-->
            <!--<ul class="dropdown-menu" id="tri">-->
            <!--<li><a href="#">je</a></li>-->
            <!--<li><a href="#">sais</a></li>-->
            <!--<li><a href="#">pas</a></li>-->
            <!--</ul>-->
            <!--</div>-->
        </div>
    </div>
    <div class="panel-body">
        <div class="col-sm-3">
            <div class="sidebar-nav">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                            <span class="sr-only">Menu</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="visible-xs navbar-brand">Menu</span>
                    </div>
                    <div class="navbar-collapse collapse sidebar-navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><?= $this->Html->link(__('Envoyer un message'), ['action' => 'send']) ?></li>
                            <li><a href="messages/dispatch">Messages envoyés <span class="badge"><?= $sendmpcount ?></span></a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="col-md-9 ">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Reçu le') ?></th>
                    <th><?= $this->Paginator->sort('Expéditeur') ?></th>
                    <th><?= $this->Paginator->sort('Sujet') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($messages as $message): ?>
                <tr>
                    <td><?= $message->created->i18nformat('dd MMMM à HH:mm') ?></td>
                    <td><?php
                $user = $users->find()->where(['id' => $message->from_user])->first();
                        echo $user->firstname.' '.$user->lastname;
                        ?></td>
                    <td><?= h($message->subject) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $message->id]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $message->id], ['confirm' => __('Etes-vous sûr de vouloir supprimer le message # {0}?', $message->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('précédant')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('suivant') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </div>
    </div>
</div>




