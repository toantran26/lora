<?php


	namespace App\Http\Library\Facade;

    use Illuminate\Support\Facades\Facade;
	class ConfigSiteFacade extends Facade
	{
        protected static function getFacadeAccessor()
        {
            return 'configSite';
        }
	}
