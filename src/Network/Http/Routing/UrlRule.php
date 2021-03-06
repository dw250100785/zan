<?php
/*
 *    Copyright 2012-2016 Youzan, Inc.
 *
 *    Licensed under the Apache License, Version 2.0 (the "License");
 *    you may not use this file except in compliance with the License.
 *    You may obtain a copy of the License at
 *
 *        http://www.apache.org/licenses/LICENSE-2.0
 *
 *    Unless required by applicable law or agreed to in writing, software
 *    distributed under the License is distributed on an "AS IS" BASIS,
 *    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *    See the License for the specific language governing permissions and
 *    limitations under the License.
 */
namespace Zan\Framework\Network\Http\Routing;

use Zan\Framework\Utilities\Types\Arr;
use Zan\Framework\Utilities\Types\Dir;
use Zan\Framework\Utilities\DesignPattern\Singleton;
use Zan\Framework\Foundation\Core\Config;

class UrlRule {

    use Singleton;

    private static $rules = [];

    public static function loadRules()
    {
        $routeFiles = Dir::glob(Config::get('path.routing'), '*.routing.php');

        if (!$routeFiles) return false;

        foreach ($routeFiles as $file)
        {
            $route = include $file;
            if (!is_array($route)) continue;
            self::$rules = Arr::merge(self::$rules, $route);
        }
    }

    public static function getRules()
    {
        return self::$rules;
    }
}