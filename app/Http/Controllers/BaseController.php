<?php

namespace App\Http\Controllers;

use App\Utils\Url;
use Illuminate\Http\Request;

class BaseController extends Controller
{
  public function __construct(Request $request)
  { 

    $method = ucfirst(Url::uriToMethod($request->getRequestUri()));
    
      parent::__construct("App\\Model\\Tables\\$method");
      
  }

}
