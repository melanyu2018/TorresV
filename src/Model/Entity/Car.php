<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Car Entity
 *
 * @property int $id
 * @property string $brand
 * @property string $car_plate
 * @property string $owner
 * @property bool $status
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\User[] $users
 */
class Car extends Entity
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
        'brand' => true,
        'car_plate' => true,
        'owner' => true,
        'status' => true,
        'created' => true,
        'users' => true
    ];
}
