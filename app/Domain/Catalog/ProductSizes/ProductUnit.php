<?php
  
namespace App\Domain\Catalog\ProductSizes;
 
enum ProductUnitEnum:string {
    case ml = 'ml';
    case l = 'l';
    case g = 'g';
    case kg = 'kg';
}