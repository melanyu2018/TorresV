<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersCars Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CarsTable|\Cake\ORM\Association\BelongsTo $Cars
 *
 * @method \App\Model\Entity\UsersCar get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersCar newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsersCar[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersCar|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersCar saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersCar patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersCar[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersCar findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersCarsTable extends Table
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

        $this->setTable('users_cars');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey(['user_id', 'car_id']);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cars', [
            'foreignKey' => 'car_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['car_id'], 'Cars'));

        return $rules;
    }
}
