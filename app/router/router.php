<?php
use app\middleware\MiddlewareSession;

function routes(){
    return[
        'GET' =>[
            '/' => "HomeController@index",
            '/loginSecretaria' => "secretary\AuthSecretaryController@showLoginSecretary",
            '/horarios' => [
                'controller' => "secretary\SchedulingSecretaryController@showSchedule",
                'middleware' => 'handleSecretary'
            ],
            '/homeSecretaria' => [
                'controller' => "secretary\HomeSecretaryController@ShowDiarySecretary",
                'middleware' => 'handleSecretary'
            ],
            '/cadastro' => "user\AuthUserController@showSignUp",
            '/login' => "user\AuthUserController@showSignIn",
            '/home' => [
                'controller' => "user\HomeUserController@showHomeUser",
                'middleware' => 'handleUser'
            ],
            '/sendMailPassword' => "user\AuthUserController@showSendMailPassword",
            '/resetPasswordConfirm' => "user\AuthUserController@showResetPasswordConfirm",
        ],

        'POST' =>[
            '/loginSecretaria' => "secretary\AuthSecretaryController@signIn",
            '/horarios' => [
                'controller' => "secretary\SchedulingSecretaryController@AddScheduleForm",
                'middleware' => 'handleSecretary'
            ],
            '/horarios/delete_id/[0-9]+' => [
                'controller' => "secretary\SchedulingSecretaryController@deleteSchedule",
                'middleware' => 'handleSecretary'
            ],
            '/horarios/put_id/[0-9]+' => [
                'controller' => "secretary\SchedulingSecretaryController@putSchedule",
                'middleware' => 'handleSecretary'
            ],
            '/logoutSecretary' => [
                'controller' =>"secretary\AuthSecretaryController@logoutSecretary",
                'middleware' => 'logout'
            ],
            '/logout' => [
                'controller' =>"user\AuthUserController@logoutUser",
                'middleware' => 'logout'
            ],
            '/cadastro' => "user\AuthUserController@signUp",
            '/login' => "user\AuthUserController@signIn",
            '/sendMailPassword' => "user\AuthUserController@sendResetPasswordEmail",
            '/resetPassword' => "user\AuthUserController@resetPassword",
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
    if (!empty($matchedUri)) {
        $routeDetails = array_values($matchedUri)[0];
        
        if (is_array($routeDetails) && isset($routeDetails['middleware'])) {
            $middlewareClass = new \app\middleware\MiddlewareSession();
            $middlewareMethod = $routeDetails['middleware'];
            $middlewareClass->$middlewareMethod();
            $controllerUri = $routeDetails['controller'];
            
        }else{
            $controllerUri = $routeDetails;
            
        }
    
        return controller($controllerUri, $params);
    }

    throw new  Exception();
   
}
    