<?php

namespace App\Models;

use App\Model\ProductSku;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $fillable = [
        'user_id', 
        'product_id', 
        'quantity', 
		'trans_date',
		'color',
		'size',
		'cookie',

    ];

    public function product()
    {
    	return $this->belongsTo(Post::class, 'product_id');
    }
    
    public function productColor()
    {
    	return $this->belongsTo(Attribute::class, 'color')->where('type',9);
    }
    
    public function productSize()
    {
    	return $this->belongsTo(Attribute::class, 'size')->where('type',9);
    }
    
    public function image(){
        if($this->product){
            
            if($this->product->productAttibutesVariationGroup()->count() > 0 and $this->sku_id)
            {
                $skuData = json_decode($this->sku_id, true);
                foreach($skuData as $title => $sku) {
                    if($title==68){
                        $hasImage =PostAttribute::where('src_id',$this->product_id)->where('reff_id',$title)->where('parent_id',$sku)->first();
                        if($hasImage){
                         return $hasImage->variationImage();   
                        }
                    }
                }
            }
            return $this->product->image();
            
        }else{
            return 'public/medies/noimage.jpg';
        }
    }
    
    public function itemAttributes(){
        $options = []; // Initialize as an empty array
        if ($this->product && $this->sku_id) {
            $skuData = json_decode($this->sku_id, true);
            foreach($skuData as $title => $sku) {
                $hasAttri = $this->product->productVariationAttributeList()->find($sku); // Find the attribute
                if ($hasAttri) {
                    $parent = $hasAttri->parent;
                    $options[$parent->name] = $hasAttri->name; // Use the parent name as key, and attribute name as value
                }
            }
        }
        return $options;
    }
    
    public function itemStock()
    {
        $stock=0;
        if($this->product){
            if($this->product->productAttibutesVariationGroup()->count() > 0 and $this->sku_id){
                $selectedIds = json_decode($this->sku_id, true);
                $proDatas = $this->product->productVariationAttributeItems()->get(['id', 'src_id', 'reguler_price', 'preorder_price', 'discount', 'final_price', 'quantity', 'stock_status']);
                    $datas = [];
                    foreach ($proDatas as $data) {
                        $attributeItemIds = $data->attributeVatiationItems()->get(['attribute_item_id']);
                        $status=false;
                        if($data->stock_status){
                            if($data->quantity > 0){
                                $status=true;
                            }
                        }
                        
                        $datas[] = [
                            'stock' => $status?$data->quantity:0,
                            'items' => $attributeItemIds
                        ];
                    }
    
                $filteredDatas = array_filter($datas, function($product) use ($selectedIds) {
                    return collect($selectedIds)->every(function($selectedId, $attributeId) use ($product) {
                        return collect($product['items'])->contains(function($item) use ($selectedId) {
                            return $item['attribute_item_id'] == $selectedId;
                        });
                    });
                });
    
                $firstProduct = array_shift($filteredDatas);
                if($firstProduct && isset($firstProduct['stock'])){
                    return $firstProduct['stock'];
                }
                
            }
            if($this->product->stockStatus()){
                $stock = $this->product->quantity;
            }else{
                $stock =0;
            }
            
        }
        return $stock;

    }

    public function itemprice()
    {
        if($this->product){
            
            if($this->product->productAttibutesVariationGroup()->count() > 0 and $this->sku_id)
            {
                $selectedIds = json_decode($this->sku_id, true);
                $proDatas = $this->product->productVariationAttributeItems()->get(['id', 'src_id', 'reguler_price', 'preorder_price', 'discount', 'final_price', 'quantity', 'stock_status']);
                    $datas = [];
                    foreach ($proDatas as $data) {
                        $attributeItemIds = $data->attributeVatiationItems()->get(['attribute_item_id']);
                        $status=false;
                        if($data->stock_status){
                            if($data->quantity > 0){
                                $status=true;
                            }
                        }
                        
                        $datas[] = [
                            'price' => $status?$data->offerPrice():$data->preorder_price,
                            'stock_status' => $status,
                            'items' => $attributeItemIds
                        ];
                    }
    
                $filteredDatas = array_filter($datas, function($product) use ($selectedIds) {
                    return collect($selectedIds)->every(function($selectedId, $attributeId) use ($product) {
                        return collect($product['items'])->contains(function($item) use ($selectedId) {
                            return $item['attribute_item_id'] == $selectedId;
                        });
                    });
                });
    
                $firstProduct = array_shift($filteredDatas);
                if($firstProduct && isset($firstProduct['price'])){
                    return $firstProduct['price'];
                }
                
            }
            
            if($this->product->stockStatus()){
                return $this->product->offerPrice();
            }else{
                return $this->product->purchase_price;
            }
            
            
        }else{
            return 0;
        }

    }
    
    

    public function subtotal()
    {
        return ($this->quantity * $this->itemprice())+($this->quantity*$this->warranty_charge);
    }
    
    public function InDhakaDeliveryCharge()
    {
        if($this->product){
         return   $this->quantity * $this->product->shipping_cost;
        }else{
         return   $this->quantity*0;
        }
    }
    public function OurOfDhakaDeliveryCharge()
    {
        if($this->product){
         return   $this->quantity * $this->product->shipping_cost2;
        }else{
         return   $this->quantity*0;
        }
        
        
    }
}
