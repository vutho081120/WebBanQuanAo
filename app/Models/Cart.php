<?php

namespace App\Models;

class Cart {
    public $products = null;
    public $totalPrice = 0;
    //public $totalQuanty = 0;

    public function __construct ($oldCart){
        if($oldCart){
            $this->products = $oldCart->products;
            $this->totalPrice = $oldCart->totalPrice; 
            //$this->totalQuanty = $cart->totalQuanty;
        }
    }

    public function addCart ($product, $id, $colorSize, $quantity){
        if ($product->sale_price != 0) {
            $gia = $product->sale_price;
        } else {
            $gia = $product->price;
        }

        $newProduct = ['soluongmua' => $quantity, 'mausacSize' => $colorSize, 'gia' => $gia, 'thanhtien' => 0, 'sanpham' => $product];

        if($this->products){
            if(array_key_exists($id, $this->products)){
                $this->totalPrice -= $this->products[$id]['thanhtien'];
                $newProduct = $this->products[$id];
                $newProduct['soluongmua'] =  $quantity;
                $newProduct['thanhtien'] = $quantity * $this->products[$id]['gia'];
                $newProduct['mausacSize'] =  $colorSize;
            }
        }

        $newProduct['thanhtien'] = $newProduct['soluongmua'] * $newProduct['gia'];
        $this->products[$id] = $newProduct;
        $this->totalPrice += $newProduct['thanhtien'];
        // $this->totalQuanty += $newProduct['soluongmua'];
    }

    public function deleteItemCart ($id){
        $this->totalPrice -= $this->products[$id]['thanhtien'];
        unset ($this->products[$id]);
    }
    
    public function updateItemCart ($id, $qty){
       
        $this->totalPrice -= $this->products[$id]['thanhtien'];

        $this->products[$id]['soluongmua'] = $qty;
        $this->products[$id]['thanhtien'] = $qty * $this->products[$id]['gia'];

        $this->totalPrice += $this->products[$id]['thanhtien'];
    }
}