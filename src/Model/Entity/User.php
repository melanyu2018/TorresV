<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $surnames
 * @property string $email
 * @property string $password
 * @property \Cake\I18n\FrozenDate|null $date_of_birth
 * @property bool $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $role_id
 * @property string $dni
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Order[] $orders
 * @property \App\Model\Entity\Car[] $cars
 * @property \App\Model\Entity\Zone[] $zones
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'surnames' => true,
        'email' => true,
        'password' => true,
        'date_of_birth' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'role_id' => true,
        'dni' => true,
        'role' => true,
        'orders' => true,
        'cars' => true,
        'zones' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
	
	protected function _setPassword($value)
	{
		if (strlen($value)) {
			$hasher = new DefaultPasswordHasher();
			return $hasher->hash($value);
		}
	}
}
