<?php

function routes(){
    return[
        'GET' =>[
            '/' => "HomeController@index",
            '/agenda/adicionar-horarios' => "SchedulingSecretaryController@showAddScheduleForm",
        ],

        'POST' =>[
            '/agenda/adicionar-horarios' => "SchedulingSecretaryController@AddScheduleForm",
        ],

        'PUT' =>[
            
        ],
        'DELETE' =>[
            
        ]
        
    ];
}

function exactMatchUriInArrayRoutes($uri ,$routes){
    if(array_key_exists($uri ,$routes )){
        return [$uri => $routes[$uri]];
    };
    return[] ;
}

function regularExpressionArrayRouter($uri ,$routes ){
   return array_filter($routes, 
   function ($value) use ($uri){
       $regex = str_replace('/','\/' ,ltrim($value , '/'));
       return preg_match("/^$regex$/" ,ltrim($uri,'/'));
   },ARRAY_FILTER_USE_KEY);
}
function params($uri,$matchedUri){
    if(!empty($matchedUri)){
        $matchedToGetParams = array_keys($matchedUri)[0];
        return array_diff(
            $uri,
            explode('/', ltrim($matchedToGetParams, '/'))
        );
    }
    return [];
}

function paramsFormat($uri,$params){
    $paramsData = [];
    foreach($params as $index => $param){
        $paramsData[$uri[$index-1]] = $param;
    }
    return $paramsData;
}

function router(){
    $uri = parse_url($_SERVER["REQUEST_URI"] , PHP_URL_PATH);
    
    $routes = routes();
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    $matchedUri =  exactMatchUriInArrayRoutes($uri ,$routes[$requestMethod]);
    $params = [];
    if(empty($matchedUri)){
        $matchedUri = regularExpressionArrayRouter($uri ,$routes[$requestMethod] );
        $uri = explode('/', ltrim($uri , '/'));
        $params = params($uri, $matchedUri);
        $params = paramsFormat($uri, $params);
        
    }
    if(!empty($matchedUri)){
        return controller($matchedUri , $params);
        
    }

    throw new  Exception();
   
}