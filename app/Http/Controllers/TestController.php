<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
  public function test()
  {
    try {
      error_log('Helooooooo');
      return response()->json([
        'message' => 'success'
      ]);
    } catch (Exception $e) {
      error_log('Error: ' . $e);
      throw $e;
    }
  }
}
