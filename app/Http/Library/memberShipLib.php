<?php
namespace App\library{
	use DB;
	use URL;
	use App\Models\MedicineInfo;
	class memberShipLib
	{
	    public static function getLinkUrl($menu_type, $cms_link, $category_link, $raw_link, $static_page_link){

	    	if($menu_type==0){
	    		$data = DB::table('product_category')->where('id', $category_link)->select('slug')->first();
	    		if($data->slug){
	    			$url_link = URL::To('categories/'.$data->slug);
	    		}else{
	    			$url_link = "javascript::";
	    		}
	    		
	    	}
	    	elseif($menu_type==1){
	    		$url_link = $raw_link; 
	    	}
	        elseif($menu_type==3){
	            $data = DB::table('static_page_collection')->where('sratic_page_id', $static_page_link)->select('page_route')->first();
	            $url_link = URL::To($data->page_route);
	        }   
	        else{
	        	$data = DB::table('cms_page')->where('id', $cms_link)->select('seo_url')->first();
	    		$url_link = URL::To('pages/'.$data->seo_url);
	        }

	        return $url_link;
	        
	    }


	    public static function get_related_products_by_slug($slug)
		{

			$productData = Product::where('slug', $slug)->first();
			$results = DB::table('products')
					   ->join('product_category', 'product_category.id', 'products.product_category')
					   ->whereNotIn('products.id', [$productData->id])
					   ->where('products.product_category', $productData->product_category)
					   ->select('products.*','products.id as product_id')
					   ->where('products.status',1)->get();
			
			return $results;
		}

		public static function getNumberFormat($number){
			if(session('configData')['digit_separator']=='comma'){
				$digitValue = number_format($number,2,".",",");
			}else if(session('configData')['digit_separator']=='dot'){
				$digitValue = number_format($number,2,",",".");
			}

			if(session('configData')['currency_space']==1){
				$space = " ";
			}else{
				$space = "";
			}
			
			if(session('configData')['currency_position']==0){
				$digitValue = session('configData')['currency'].$space.$digitValue;
			}else{
				$digitValue = $digitValue.$space.session('configData')['currency'];
			}

			return $digitValue;
		}

	}
}