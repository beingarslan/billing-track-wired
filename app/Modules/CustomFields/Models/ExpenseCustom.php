<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\CustomFields\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCustom extends Model
{
    use SoftDeletes;

    protected $casts = ['deleted_at' => 'datetime'];

    protected $table = 'expenses_custom';

    protected $primaryKey = 'expense_id';

    protected $guarded = [];
}
