<?php
  namespace App;

  use Exception;

  class Exceptions {
    public static function pregMatchFaild(string $regularExpresion, string $subject): Exception {
      $properties = [
        'pregError' => array_flip(get_defined_constants(true)['pcre'])[preg_last_error()],
        'regularExpresion' => $regularExpresion,
        'subject' => $subject
      ];

      $message = "Preg match faild.\n\n" . self::implode($properties);
      return new Exception($message, 1);
    }

    protected static function implode(array $properties): string {
      $messages = [];

      foreach ($properties as $key => $value) {
        $messages[] = "{$key}: $value";
      }

      return implode("\n", $messages);
    }
  }
