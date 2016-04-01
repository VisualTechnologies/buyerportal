<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $primaryKey = 'product_id'; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name', 'product_description', 'sku', 'upc', 'cost', 'price', 'user_id', 'seller_id'
    ];

    /**
     * Get the seller of this item
     */
    public function seller()
    {
        return $this->belongsTo('App\Seller', 'seller_id', 'id');
    }

    /**
     * Get the user that owns the product.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Get the items in the list
     */
    public function images()
    {
        return $this->hasMany('App\MediaItem');
    }

    public function getThumbnail()
    {
        return $this->getFeaturedImage()->thumbnail;
    }

    public function getFeaturedImageUrl()
    {
        return $this->getFeaturedImage()->url;
    }

    public function getFeaturedImage()
    {
        return $this->images()->first();    // todo: change this to check for the featured image.
    }


}