<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Formations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Organizations
 * @property \Cake\ORM\Association\BelongsTo $Teachers
 * @property \Cake\ORM\Association\BelongsTo $Events
 *
 * @method \App\Model\Entity\Formation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Formation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Formation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Formation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Formation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Formation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Formation findOrCreate($search, callable $callback = null)
 */
class FormationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('formations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id'
        ]);
        $this->belongsTo('Teachers', [
            'foreignKey' => 'teacher_id'
        ]);
        $this->belongsTo('Events', [
            'foreignKey' => 'event_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'));
        $rules->add($rules->existsIn(['teacher_id'], 'Teachers'));
        $rules->add($rules->existsIn(['event_id'], 'Events'));

        return $rules;
    }
}
