<?php

namespace Peeyush\Sanitizer;

use Peeyush\Sanitizer\Sanitizer as Sanitize;

class Factory
{
    protected $extensions = [];

    public function make(array $data, array $filters)
    {
        $sanitizer = new Sanitize($data, $filters, $this->extensions);
        $sanitizer->addExtensions($this->extensions);
        return $sanitizer;
    }

    public function extend($filter, $extension)
    {
        $this->extensions[$filter] = $extension;
    }
}