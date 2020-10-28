<?php


// URLparser concept
// #################

// http://192.168.67.243/kanbatik-mvc/test/tester?test=true&noob=1

// Array ( [test] => true [noob] => 1 )
// /kanbatik-mvc/test/tester.php      


// Just some notes
// sections == folders
// login, register, dashboard, profile, administration


function getRoutsFromDB($uri)
{
    $arrRouts = $GLOBALS['db']->select(
        "RoutsConfig",
        [
            "ID",
            "REQ_URL",
            "HEADER",
            "FOOTER"
        ],
        [
            "REQ_URL" => $uri
        ]
    );
    return $arrRouts;
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
            //print_r($getParams);
        }
    } else {
        $uri[0] = getenv('REQUEST_URI');
        $uri[1] = '';
    }

    $GLOBALS['URLparam'] = explode('/', $uri[0]);

    if (!empty($GLOBALS['URLparam'][1])) {
        $pc = count($GLOBALS['URLparam']) - 1;

        for ($i = 1; $i <= $pc; $i++) {
            $GLOBALS['REQuri'] .= '/' . $GLOBALS['URLparam'][$i];
            //echo '<br><br>';
            //echo substr($GLOBALS['REQuri'], -4);
            //echo '<br><br>';
            if (substr($GLOBALS['REQuri'], -1) == '/') {
                Print_r('error');
            } else {
                if ($pc < 2) {
                    $GLOBALS['REQuri'] .= '/index';
                }
            }
        }
        $GLOBALS['REQuri'] .= '.php';
    }

    $reqView = '/views' . $GLOBALS['REQuri'];
    $arrViewElements = getRoutsFromDB($reqView);
    if (!empty($arrViewElements)) {
        $reqHeader = $GLOBALS['RP'] . $arrViewElements[0]['HEADER'];
        $reqFooter = $GLOBALS['RP'] . $arrViewElements[0]['FOOTER'];
    } else {
        $reqHeader = $GLOBALS['RP'] . '/views/_globals/header.php';
        $reqFooter = $GLOBALS['RP'] . '/views/_globals/footer.php';
    }
   // echo '<br><br>' . $reqHeader;
   // echo '<br><br>' . $reqFooter;
}
