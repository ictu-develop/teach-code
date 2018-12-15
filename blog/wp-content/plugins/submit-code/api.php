
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/18
 * Time: 2:23 PM
 */
header('Content-Type: application/json; charset=UTF-8');

class Submit
{

    /*public $token = 'f6583e60-fdfdfdf-sdd';
    public $api_url_authenticate = 'https://api.judge0.com/authenticate?X-Auth-Token=';
    public $api_url_authorize = 'https://api.judge0.com/authorize?X-Auth-User=';*/
    public $api_url_submit = 'https://api.judge0.com/submissions?wait=true&base64_encoded=true';

    //public $memory_limit_ = 128000;

    // Xac thuc
    /*function authenticate()
    {
        $ch = curl_init($this->api_url_authenticate . $this->token);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo $http_code;
        curl_close($ch);
        return $http_code;
    }*/

    // Uy quyen
    /*function authorize()
    {
        $ch = curl_init($this->api_url_authorize . $this->token);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo $http_code;
        curl_close($ch);
        return $http_code;
    }*/

    function submissions($source_code, $stdin, $expected_output, $lang_id, $cpu_time_limit)
    {
        $string = '{
            "source_code": "'.base64_encode($source_code).'",
            "language_id": '.$lang_id.',
            "stdin": "'.$stdin.'",
            "expected_output": "'.$expected_output.'",
            "cpu_time_limit": '.$cpu_time_limit.'
        }';

        $ch = curl_init($this->api_url_submit);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $res = trim(curl_exec($ch));
        //echo "input ".base64_decode($stdin)." : output: ".base64_decode($expected_output)." \n";
        echo $res;
    }

}

$stdin = $_POST['stdin'];
$expected_output = $_POST['expected_output'];
$source = $_POST['source'];
$lang_id = (int) $_POST['lang_id'];
$cpu_time_limit = 2; // default is 2 second, next version will custom it

/*
 *
 * lang_id: 26 (java JDK 9)
 * lang_id: 4 (C - gcc 7.2.0)
 * lang_id: 10 (C - g++ 7.2.0)
 * lang_id: 22 (Go -1.9)
 * lang_id: 34 (Python - 3.6.0)
 *
 * */

switch ($lang_id){
    case 26: {
        $cpu_time_limit = 5;
        setcookie("lang_id", $lang_id, time() + 86400 * 365, '/');
        break;
    }
    case 4: {
        setcookie("lang_id", $lang_id, time() + 86400 * 365, '/');
        break;
    }
    case 10: {
        setcookie("lang_id", $lang_id, time() + 86400 * 365, '/');
        break;
    }
    case 22: {
        setcookie("lang_id", $lang_id, time() + 86400 * 365, '/');
        break;
    }
    case 34: {
        setcookie("lang_id", $lang_id, time() + 86400 * 365, '/');
        break;
    }
    default: {
        $cpu_time_limit = 2;
        break;
    }
}
$obj = new Submit();

$obj->submissions($source, base64_encode($stdin), base64_encode($expected_output), $lang_id, $cpu_time_limit);
