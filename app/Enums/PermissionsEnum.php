<?php

namespace App\Enums;

enum PermissionsEnum: string
{
  case ApprovedVendors = 'ApprovedVendors';
  case BuyProducts = 'BuyProducts';
  case SellProducts = 'SellProducts';
}
