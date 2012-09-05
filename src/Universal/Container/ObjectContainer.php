<?php
/*
 * This file is part of the Universal package.
 *
 * (c) Yo-An Lin <cornelius.howl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace Universal\Container;
use Exception;
class ObjectContainer 
{
    public $builders = array();

    public $_cachedObjects = array();

    private $_cache = true;

    public function setCache($bool)
    {
        $this->_cache = $bool;
    }

    public function has($key)
    {
        return isset($this->builders[ $key ]);
    }

    public function singletonInstance($key)
    {
        if( $this->_cache && isset( $this->_cachedObjects[ $key ] ) ) {
            return $this->_cachedObjects[ $key ];
        }
        elseif( isset( $this->builders[ $key ] ) ) {
            return $this->_cachedObjects[ $key ] = $this->instance($key);
        }
        else {
            throw new Exception("Builder not found: $key");
        }
    }

    public function instance($key)
    {
        if( $b = $this->getBuilder($key) ) {
            if( is_callable($b) ) {
                return call_user_func($b);
            } else {
                return $b;
            }
        }
    }

    public function getBuilder($key)
    {
        if( isset($this->builders[$key]) ) {
            return $this->builders[ $key ];
        }
    }

    public function __get($key)
    {
        return $this->singletonInstance($key);
    }

    public function __set($key,$builder) 
    {
        $this->builders[ $key ] = $builder;
    }

    public function __isset($key)
    {
        return $this->has($key);
    }

}
