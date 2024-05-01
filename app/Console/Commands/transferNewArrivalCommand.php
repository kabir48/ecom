<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;
use Carbon\Carbon;

class transferNewArrivalCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arrival:updates';

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
        $products = Product::where('is_feature',"Yes")->get();
        foreach($products as $product){
           $currentDate=Carbon::now()->toDateString();
           if($product->arrival_date==$currentDate){
               Product::where('id',$product->id)->update(['discount_date'=>NULL,'discount_price'=>NULL]);
           }
        }
       $this->info('Arrival Page Updated.');
    }
}
