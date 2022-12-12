<?php

namespace App\Http\Middleware;

use Auth;
use Redirect;

class AdminFilter
{
    const ROUTE_PREFIX = 'admin';

    public function handle($request, \Closure $next)
    {
        $res = $this->filter($request->route(), $request);

        if($res) {
            return $res;
        }

        return $next($request);
    }

    public function filter($route, $request, $value = null)
    {
        $name = $route->getName();

        $user = Auth::guard('admin')->user();

        $matches = [];
        //get the route
        if( preg_match('/^' . self::ROUTE_PREFIX . '\.(.*)\.(index|show|create|edit|update|store|destroy)$/', $name, $matches) ) {
            $resource = $matches[1];
            $action = $matches[2];

            //check each action
            switch($action) {
                case 'index':
                case 'show':
                    $permission = $resource . '.view';
                    break;
                case 'create':
                case 'store':
                    $permission = $resource . '.create';
                    break;
                case 'edit':
                case 'update':
                    $permission = $resource . '.edit';
                    break;
                case 'destroy':
                    $permission = $resource . '.delete';
                    break;
                default:
                    throw new \Exception("Unknown Route");
            }
        } else {
            //no named route, so check custom routes for uri
            $uri = $route->uri();

            //get the permission
            $permission = Arr::where(Config::get('adminresources.custom_routes'), function($v, $k) use ($uri) {
                return preg_match('/^' . AdminFilter::ROUTE_PREFIX . '\/' . str_replace(array('/', '{', '}'), array('\/', '\{', '\}'), $v['uri']) . '$/', $uri);
            });

            if ( empty($permission) ) {
                throw new \Exception("Unknown Route");
            }
            //permission name
            $permission = array_values($permission)[0]['permission'];
        }

        $user = Auth::guard('admin')->user();

        if(! $user) {
            return Redirect::guest('/');
        }
    }
}
