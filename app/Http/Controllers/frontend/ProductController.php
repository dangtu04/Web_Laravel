<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Product all
    public function index()
    {
        $list_product = Product::where('status', '=', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('frontend.product', compact('list_product'));
    }

    // get list category
    public function getlistcategoryid($rowid){
        $listcatid = [];        
      
        array_push($listcatid, $rowid);
        $list1 = Category::where([['parent_id', '=', $rowid], ['status', '=', 1]])->select("id")->get();
        if (count($list1) > 0) {
            foreach ($list1 as $row1) {
                array_push($listcatid, $row1->id);
                $list2 = Category::where([['parent_id', '=', $row1->id], ['status', '=', 1]])->select("id")->get();
                if (count($list2) > 0) {
                    foreach ($list2 as $row2) { 
                        array_push($listcatid, $row2->id);
                    }
                }
            }
        }
        return $listcatid;        
    }   

    // product category 
    public function category($slug)
    {
        $row = Category::where([['slug', '=', $slug], ['status', '=', 1]])->select("id", "name", "slug")->first();
        $listcatid = [];
        if ($row != null) {
            $listcatid = $this->getlistcategoryid($row->id);
        }
        $list_product = Product::where('status', '=', 1)
            ->whereIn('category_id',$listcatid)
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('frontend.product_category', compact('list_product','row'));
    }

    public function product_detail($slug) {
        $product = Product::where([['status', '=', 1], ['slug', '=', $slug]])->first();
        $listcatid = $this->getlistcategoryid($product->category_id);
        $list_product = Product::where([['status', '=', 1],['id', '!=', $product->id]])
            ->whereIn('category_id', $listcatid)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return view('frontend.product_detail', compact('product', 'list_product'));
    }
    
}
