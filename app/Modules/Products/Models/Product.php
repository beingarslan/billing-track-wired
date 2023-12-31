<?php


/**
 * This file is part of BillingTrack.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Products\Models;

use BT\Support\CurrencyFormatter;
use BT\Support\NumberFormatter;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

	protected $table = 'products';

    public function vendor()
    {
        return $this->belongsTo('BT\Modules\Vendors\Models\Vendor')->withDefault(['name' => '']);
    }

    public function category()
    {
        return $this->belongsTo('BT\Modules\Categories\Models\Category')->withDefault(['name' => '']);
    }

    public function purchaseorders()
    {
        return $this->hasMany('BT\Modules\Purchaseorders\Models\Purchaseorder');
    }

    public function inventorytype()
    {
        return $this->belongsTo('BT\Modules\Products\Models\InventoryType');
    }

    public function quoteitem()
    {
        return $this->belongsTo('BT\Modules\Quotes\Models\QuoteItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function workorderitem()
    {
        return $this->belongsTo('BT\Modules\Workorders\Models\WorkorderItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function invoiceitem()
    {
        return $this->belongsTo('BT\Modules\Invoices\Models\InvoiceItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function recurringinvoiceitem()
    {
        return $this->belongsTo('BT\Modules\RecurringInvoices\Models\RecurringInvoiceItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function purchaseorderitem()
    {
        return $this->belongsTo('BT\Modules\Purchaseorders\Models\purchaseorderItem','resource_id', 'id')
            ->where('resource_table','=','products');
    }

    public function taxRate()
    {
        return $this->belongsTo('BT\Modules\TaxRates\Models\TaxRate')->withDefault(['name' => '']);
    }

    public function taxRate2()
    {
        return $this->belongsTo('BT\Modules\TaxRates\Models\TaxRate', 'tax_rate_2_id')->withDefault(['name' => '']);
    }

    public function getIsTrackableAttribute(){
        return $this->inventorytype->tracked;
    }


    public function getFormattedPriceAttribute()
    {
        return CurrencyFormatter::format($this->attributes['price']);
    }

    public function getFormattedCostAttribute()
    {
        return CurrencyFormatter::format($this->attributes['cost']);
    }

    public function getFormattedNumericPriceAttribute()
    {
        return NumberFormatter::format($this->attributes['price']);
    }

    public function getFormattedActiveAttribute(){
        return $this->active ? trans('bt.yes') : trans('bt.no');
    }

    //inventory tracked scope
    public function scopeTracked($query)
    {
        return $query->whereIn('inventorytype_id', InventoryType::where('tracked', 1)->get('id'));
    }

    public function scopeStatus($query, $status)
    {
        if ($status == 'active')
        {
            $query->where($this->table . '.active', 1);
        }
        elseif ($status == 'inactive')
        {
            $query->where($this->table . '.active', 0);
        }

        return $query;
    }
}
