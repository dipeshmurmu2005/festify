<?php

namespace App\Traits;

trait BookingCodeGenerator
{
    public function generateBookingCode($id)
    {
        return 'BK-' . $this->safeBase36Code10($id);
    }

    private function safeBase36Code10(int $id): string
    {
        $hash = crc32($id);

        return strtoupper(str_pad(base_convert($hash, 10, 36), 10, '0', STR_PAD_LEFT));
    }
}
