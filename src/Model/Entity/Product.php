<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $quantity
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $created
 * @property bool $status
 * @property string $code
 * @property string $description
 *
 * @property \App\Model\Entity\OrderDetail[] $order_detail
 */
class Product extends Entity
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
        'price' => true,
        'quantity' => true,
        'modified' => true,
        'created' => true,
        'status' => true,
        'code' => true,
        'description' => true,
        'order_detail' => true
    ];
}
