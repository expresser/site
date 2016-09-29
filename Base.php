<?php namespace Expresser\Site;

use Closure;

use WP_Site;
use WP_Site_Query;

abstract class Base extends \Expresser\Support\Model {

  protected $site;

  public function __construct(WP_Site $site = null) {

    $this->site = $site ?: new WP_Site((object)[]);

    parent::__construct($this->site->to_array());
  }

  public function newQuery() {

    $query = (new Query(new WP_Site_Query))->setModel($this);

    return $query;
  }

  public function toggleToSite(Base $site, Closure $callback, array $parameters = []) {

    return static::switchToSite($site, $this, $callback, $parameters);
  }

  public function __get($key) {

    if (is_null($value = parent::__get($key))) {

      $value = $this->site->$key;
    }

    return $value;
  }

  public static function switchToSite(Base $targetSite, Base $currentSite, Closure $callback, array $parameters = []) {

    array_unshift($parameters, $targetSite);

    switch_to_blog($targetSite->blog_id);

    $out = call_user_func_array($callback, $parameters);

    switch_to_blog($currentSite->blog_id);

    return $out;
  }
}
