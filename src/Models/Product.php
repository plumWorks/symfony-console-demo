<?php
  namespace App\Models;

  class Product {
    protected $title;
    protected $price;
    protected $inventory;

    public function __construct($title, $price, $inventory) {
      $this->title = $title;
      $this->price = $price;
      $this->inventory = $inventory;
    }

    public function __get($property) {
      return $this->$property;
    }
  }
