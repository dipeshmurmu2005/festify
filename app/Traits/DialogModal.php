<?php

namespace App\Traits;

trait DialogModal
{
    public function openModal($modal)
    {
        $this->js($modal . ".showModal()");
    }

    public function closeModal($modal)
    {
        $this->js($modal . ".close()");
    }
}
