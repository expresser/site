<?php namespace Expresser\Site;

use InvalidArgumentException;

use WP_Site_Query;

class Query extends \Expresser\Support\Query {

  public function __construct(WP_Site_Query $query) {

    parent::__construct($query);
  }

  public function find($id) {

    return $this->site($id)->first();
  }

  public function findAll(array $ids) {

    return $this->sites($ids)->get();
  }

  public function first() {

    return $this->limit(1)->get()->first();
  }

  public function limit($limit) {

    return $this->number($limit);
  }

  public function site($id) {

    if (is_int($id)) {

      $this->ID = $id;
    }
    else {

      throw new InvalidArgumentException;
    }

    return $this;
  }

  public function sites(array $ids, $operator = 'IN') {

    switch ($operator) {

      case 'IN':

        $this->site__in = $ids; break;

      case 'NOT IN':

        $this->site__not_in = $ids; break;

      default:

        throw new InvalidArgumentException;
    }

    return $this;
  }

  public function number($number) {

    $this->number = $number;

    return $this;
  }

  public function offset($offset) {

    $this->offset = $offset;

    return $this;
  }

  public function orderBy($orderby = 'id', $order = 'ASC') {

    $this->orderby = $orderby;
    $this->order = $order;

    return $this;
  }

  public function network($id) {

    if (is_int($id)) {

      $this->network_id = $id;
    }
    else {

      throw new InvalidArgumentException;
    }

    return $this;
  }

  public function networks(array $ids, $operator = 'IN') {

    switch ($operator) {

      case 'IN':

        $this->network__in = $ids; break;

      case 'NOT IN':

        $this->network__not_in = $ids; break;

      default:

        throw new InvalidArgumentException;
    }

    return $this;
  }

  public function domain($domain) {

    if (is_string($domain)) {

      $this->domain = $domain;
    }
    else {

      throw new InvalidArgumentException;
    }

    return $this;
  }

  public function domains(array $domains, $operator = 'IN') {

    switch ($operator) {

      case 'IN':

        $this->domain__in = $domains; break;

      case 'NOT IN':

        $this->domain__not_in = $domains; break;

      default:

        throw new InvalidArgumentException;
    }

    return $this;
  }

  public function path($path) {

    if (is_string($path)) {

      $this->path = $path;
    }
    else {

      throw new InvalidArgumentException;
    }

    return $this;
  }

  public function paths(array $paths, $operator = 'IN') {

    switch ($operator) {

      case 'IN':

        $this->path__in = $paths; break;

      case 'NOT IN':

        $this->path__not_in = $paths; break;

      default:

        throw new InvalidArgumentException;
    }

    return $this;
  }

  public function archive($isArchive = true) {

    if (is_bool($isArchive)) {

      $this->archive = $isArchive ? '1' : '0';
    }
    else {

      throw new InvalidArgumentException;
    }

    return $this;
  }

  public function mature($isMature = true) {

    if (is_bool($isSpam)) {

      $this->spam = $isSpam ? '1' : '0';
    }
    else {

      throw new InvalidArgumentException;
    }

    $this->mature = $isMature ? '1' : '0';

    return $this;
  }

  public function spam($isSpam = true) {

    if (is_bool($isSpam)) {

      $this->spam = $isSpam ? '1' : '0';
    }
    else {

      throw new InvalidArgumentException;
    }

    return $this;
  }

  public function deleted($isDeleted = true) {

    if (is_bool($isDeleted)) {

      $this->deleted = $isDeleted ? '1' : '0';
    }
    else {

      throw new InvalidArgumentException;
    }

    return $this;
  }

  public function search($terms, array $columns = []) {

    $this->search = $terms;
    $this->date_query = $$columns;

    return $this;
  }

  public function updateSiteCache($enable = false) {

    if (is_bool($enable)) {

      $this->update_site_cache = $enable;
    }
    else {

      throw new InvalidArgumentException;
    }

    return $this;
  }

  // TODO: Date Query implementation
  public function date() {

    return $this;
  }

  public function __call($method, $parameters) {

    if (str_is($method, 'public')) {

      list($isPublic) = $parameters;

      if (is_bool($isPublic)) {

        $this->public = $isPublic ? '1' : '0';
      }
      else {

        throw new InvalidArgumentException;
      }

      return $this;
    }
  }
}
