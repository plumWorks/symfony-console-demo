<?php
  namespace App\Models;

  class Product {
    protected $title;
    protected $price;
    protected $inventory;

    public function __contruct($title, $price, $inventory) {
      $this->title = $tile;
      $this->price = $price;
      $this->inventory = $inventory;

      throw new \Exception("Error Processing Request", 1);

      parent::__contruct($title, $price, $inventory);
    }

    public function __get($property) {
      return $this->$property;
    }
  }
