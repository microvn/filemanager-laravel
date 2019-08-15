<?php

namespace App\Http\Middleware;

use Closure;

class UploadFile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = "CALLFUNCTION_HANDLE_USER_HERE";
        $now = new \DateTime('now');
        $day = $now->format('d');
        $month = $now->format('m');
        $year = $now->format('Y');
        $namespace = 'PATH_NAME_OF_PROJECT';

        $pathList = [$namespace, $userId, $year, $month, $day];
        $firstPath = $pathList[0];
        foreach ($pathList as $key => $item) {
            $data = self::createPatch($_a);
            if ($key < count($pathList) - 1) {
                $firstPath = $data . '/' . $pathList[$key + 1];
            }
        }


        //HoangHn - Override Path Elfinder by user
        //\Config::set('elfinder.roots.0.path', env('PATH_IMAGE') . '/' . $namespace . '/' . $userId);
        //\Config::set('elfinder.roots.0.dir', [$year, $month, $day]);
        //\Config::set('elfinder.roots.0.URL', env('DOMAIN_IMAGE') . $userId);
        //\Config::set('elfinder.roots.0.startPath', env('PATH_IMAGE', '/zdata/cloud') . '/' . $namespace . '/' . $userId . '/' . $year . '/' . $month . '/' . $day);


        return $next($request);
    }

    function createPatch($path)
    {
        if (!\File::exists(env('PATH_IMAGE') . '/' . $path)) {
            \File::makeDirectory(env('PATH_IMAGE') . '/' . $path, 0755);
        }
        return $path;
    }
}

