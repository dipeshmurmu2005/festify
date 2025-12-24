<?php

namespace App\Traits;

use Milon\Barcode\DNS1D;

trait BarCodeGenerator
{
    public function generateBarcode($id)
    {

        $generate = new DNS1D();
        $code = $generate->getBarcodePNG('10000', 'C39+', '3', '80');
        return $code;
    }
}
