<?php

namespace Sivanov\LaravelGuardPass\Http\Middleware;

use Config;
use Closure;
use Sivanov\LaravelGuardPass\Traits\StringToArrayTrait;

class StringToArray
{
    use StringToArrayTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $s = $request->route()->parameters['StringToArray'] ?? null;
        $request->route()->parameters['StringToArray'] = $this->StringToArray($s);
        return $next($request);
    }

    /**
     * 
     */
    public function getDefaults()
    {
        return $this->newArray(Config::get('guardpass.defaults.columns'));
    }
}
