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

  public function toggleToSite($siteId, Closure $callback, array $parameters = []) {

    return static::switchToSite($this->site_id, $siteId, $callback, $parameters);
  }

  public static function switchToSite($currentSiteId, $targetSiteId, Closure $callback, array $parameters = []) {

    switch_to_blog($targetSiteId);

    $out = call_user_func_array($callback, $parameters);

    switch_to_blog($currentSiteId);

    return $out;
  }
}
