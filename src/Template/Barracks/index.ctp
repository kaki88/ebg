<div class='col-md-3'>
    <div class="sidebar-nav linkout">
        <div class="navbar navbar-default" role="navigation">

            <ul class="nav nav-pills nav-stacked">
                <li class="active" ><a href="javascript:;"> Afficher par
                </a>
                </li>
                <li><a href="<?= $this->Url->build(['controller' => 'barracks','action' => 'index']); ?>">Arborescence</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'barracks','action' => 'annuaire']); ?>">Liste </a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'barracks','action' => 'carte']); ?>">Carte</a></li>
            </ul>
        </div>
    </div>



    <?php echo $this->Form->create('Post',array('id' => 'form-map' , 'class' => 'form-horizontal' , 'type' => 'post','url' => array('controller' => 'barracks', 'action' => 'index'))); ?>

    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map" aria-hidden="true"></i></span>
            <?= $this->Form->input('region', ['empty' => 'Tri par Region','options' => $region , 'label' => false , 'templates' => [
            'inputContainer' => '{{content}}'
            ]]);  ?>
        </div>
    </div> <br> <br>

        <div class="col-md-12">
        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
            <?= $this->Form->input('departement', ['empty' => 'Tri par Departement','options' => $dpt , 'label' => false , 'templates' => [
            'inputContainer' => '{{content}}'
            ]]);  ?>
        </div>
        </div> <br> <br>

    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
            <?= $this->Form->input('nom', ['label' => false , 'placeholder'=>'recherche par nom', 'templates' => [
            'inputContainer' => '{{content}}'
            ]]);  ?>
        </div>
    </div> <br> <br>

    <div class="col-md-12">
        <div class="input-group">
            <?=  $this->Form->input('parent', ['type' => 'checkbox' , 'label' => 'Parents uniquement']) ;   ?>
            <?=  $this->Form->input('enfant', ['type' => 'checkbox' , 'label' => 'Enfants uniquement']) ;   ?>
        </div>
    </div> <br> <br>
    <?=   $this->Form->submit('Rechercher', ['class' => 'btn btn-success center-block']) ;
                  $this->Form->end() ;
                 ?>
    </div>





<div class='col-md-9'>

    <div class="panel panel-primary">
        <div class="panel-heading"><?= __('Vue arborescente des Casernes') ?>
        </div>
    <table cellpadding="0" cellspacing="0" class="table table-striped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('caserne') ?></th>
				<th><?= h('Informations') ?></th>
                <th><?= h('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
    <?php foreach( $barracks as $id => $barrack ) { ?>
    <?php $name = str_replace( '_' , '---' , $barracks_tree[ $barrack->id ] ); ?>
            <tr>
                <td><?= $name ?></td>
				<td>
                	<?php
						echo $this->Html->badge( $this->Html->icon('user') . ' ' . count( $barrack->users ) , ['escape' => false]) ;
						echo $this->Html->badge( $this->Html->icon('briefcase') . ' ' . count( $barrack->material_stocks ) , ['escape' => false] ) ;
                    echo $this->Html->badge( $this->Html->icon('road') . ' ' . count( $barrack->vehicles ) , ['escape' => false] ) ;

                    ?>
                </td>
                <td>                <a href="<?= $this->Url->build(['controller' => 'barracks','action' => 'view' , $barrack->id]); ?>" class="btn btn-default  btn-sm" ><i class="glyphicon glyphicon-eye-open"></i></a>
                </td>
            </tr>		
	<?php }	?>
    	</tbody>
    </table>
</div>

    <script>
            $('#region').change(function(){
                getdpt()
            });
        function getdpt(){
            $.ajax({
                type: 'POST',
                url: '<?= $this->Url->build(["controller" => "Barracks","action" => "getdpt"]); ?>',
                data  : "id="+$('#region').val(),
                success: function (data) {
                    $('#departement').html(data);
                }
            });
        }
    </script>