<?php
// URLparser concept
// #################

// http://192.168.67.243/kanbatik-mvc/test/tester?test=true&noob=1

// Array ( [test] => true [noob] => 1 )
// /kanbatik-mvc/test/tester.php      


// Just some notes
// sections == folders
// login, register, dashboard, profile, administration


class reqURL {
    private $reqURL; //actuallu requestet url

    public function __construct()
    {
        $GLOBALS['REQuri'] = NULL;
        $this->reqURL = getenv('REQUEST_URI');

        if ($this->reqURL != '/') {
            $this->handleGET();
        }

    }

    private function handleGET(): void{
        $getParams = [];

        
    }


}


$GLOBALS['REQuri'] = NULL;
if (getenv('REQUEST_URI') != '/') {
    if (strpos(getenv('REQUEST_URI'), 'admin')) {
        $GLOBALS['admin'] = TRUE;
    }
    
    if (strpos(getenv('REQUEST_URI'), '?')) {
        $uri = explode('?', getenv('REQUEST_URI'));
        parse_str($uri[1], $getParams);
        if (isset($getParams)) {
            // Handle get params
            print_r($getParams);
        }
    } else {
        $uri[0] = getenv('REQUEST_URI');
        $uri[1] = '';
    }

    $GLOBALS['URLparam'] = explode('/', $uri[0]);

    if (!empty($GLOBALS['URLparam'][1])) {
        $pc = count($GLOBALS['URLparam']) - 1;
        $GLOBALS['reqFile'] = $GLOBALS['URLparam'][$pc] . '.php';
        print_r('<BR><BR><BR>'.$GLOBALS['reqFile']);
        for ($i = 1; $i <= $pc; $i++) {
            $GLOBALS['REQuri'] .= '/' . $GLOBALS['URLparam'][$i];
            //if($i == $pc && substr($GLOBALS['URLparam'][$i], -1) == '/'){
            if($i == $pc -1){
                print_r('<BR><BR><BR>'.$GLOBALS['URLparam'][$i]);
                //$GLOBALS['REQuri'] .= 'index';
            }
        }
        $GLOBALS['REQuri'] .= '.php';
    }
}     