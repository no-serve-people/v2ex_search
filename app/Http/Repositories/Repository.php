<?php

namespace App\Http\Repositories;

use App\Contracts\XblogCache;
use Closure;

abstract class Repository
{
    /**
     * @var XblogCache
     */
    private $xblogCache;

    public abstract function model();

    public abstract function tag();

    public function find($id)
    {
        $model = $this->remember($this->tag() . '.id' . $id, function () use ($id) {
            return $this->model()->findOrFail($id);
        });
        return $model;
    }

    private function getXblogCache()
    {
        if ($this->xblogCache == null) {
            $this->xblogCache = app('XblogCache');
            $this->xblogCache->setTag($this->tag());
            $this->xblogCache->setTime($this->cacheTime());
        }
        return $this->xblogCache;
    }

    public function cacheTime()
    {
        return 60;
    }

    public function count()
    {
        $count = $this->remember($this->tag() . '.count', function () {
            return $this->model()->count();
        });
        return $count;
    }

    public function all()
    {
        $all = $this->remember($this->tag() . '.all', function () {
            return $this->model()->all();
        });
        return $all;
    }

    public function remember($key, Closure $entity, $tag = null)
    {
        return $this->getXblogCache()->remember($key, $entity, $tag);
    }

    public function forget($key, $tag = null)
    {
        $this->getXblogCache()->forget($key, $tag);
    }

    public function clearCache($tag = null)
    {
        $this->getXblogCache()->clearCache($tag);
    }

    public function clearAllCache()
    {
        $this->getXblogCache()->clearAllCache();
    }

}