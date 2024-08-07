<?php

class Addons
{
    public $addonsjs = [];
    public $addonscss = [];

    public function __construct($addonsjs = [], $addonscss = [])
    {
        $this->addonsjs = $addonsjs;
        $this->addonscss = $addonscss;
    }

    public function init($addons)
    {
        isset($addons['js']) ? array_push($this->addonsjs, ...$addons['js']) : null;
        isset($addons['css']) ? array_push($this->addonscss, ...$addons['css']) : null;
    }

    public function js()
    {
        foreach ($this->addonsjs as $addon) {
            echo $addon;
        }
    }

    public function css()
    {
        foreach ($this->addonscss as $addon) {
            echo $addon;
        }
    }
}
