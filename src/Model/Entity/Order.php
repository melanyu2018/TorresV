<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $ballot_number
 * @property int $user_id
 * @property float $amount
 * @property int $reload
 * @property \Cake\I18n\FrozenDate $date
 * @property bool $status_delivery
 * @property bool $status_payment
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\OrderDetail[] $order_detail
 */
class Order extends Entity
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
        'ballot_number' => true,
        'user_id' => true,
        'amount' => true,
        'reload' => true,
        'date' => true,
        'status_delivery' => true,
        'status_payment' => true,
        'user' => true,
        'order_detail' => true
    ];
}
