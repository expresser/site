<?php namespace Expresser\Site;

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
}
