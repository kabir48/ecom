<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;
use Carbon\Carbon;

class DiscountCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discount:updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $products = Product::whereNotNull('discount_price')->get();
       if(count($products)>0){
           foreach($products as $product){
               $currentDate=Carbon::now()->toDateString();
               if($product->discount_date==$currentDate){
                   Product::where('id',$product->id)->update(['discount_date'=>NULL,'discount_price'=>NULL]);
               }
           }
            $this->info('Discount Page Updated.');
        }
       
    }
}
