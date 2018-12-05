
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

    public $token = 'f6583e60-fdfdfdf-sdd';
    public $api_url_submit = 'https://api.judge0.com/submissions?wait=true&base64_encoded=true';
    public $api_url_authenticate = 'https://api.judge0.com/authenticate?X-Auth-Token=';
    public $api_url_authorize = 'https://api.judge0.com/authorize?X-Auth-User=';

    public $aut_header = 'X-Auth-Token';
    public $source_code = null;
    public $lang = 4;
    public $cpu_limit = 2;
    public $cpu_extra_time = 0.5;
    public $wall_time_limit = 5;
    public $memory_limit_ = 128000;
    public $stack_limit = 64000;

    // Xac thuc
    function authenticate()
    {
        $stdin = '';
        $expected_output = '';

        $ch = curl_init($this->api_url_authenticate . $this->token);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo $http_code;
        curl_close($ch);
        return $http_code;
    }

    // Uy quyen
    function authorize()
    {
        $ch = curl_init($this->api_url_authorize . $this->token);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo $http_code;
        curl_close($ch);
        return $http_code;
    }

    function submissions($source_code, $stdin, $expected_output)
    {
        $string = '{
            "source_code": "'.base64_encode($source_code).'",
            "language_id": 4,
            "stdin": "'.$stdin.'",
            "expected_output": "'.$expected_output.'"
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
$obj = new Submit();

$obj->submissions($source, base64_encode($stdin), base64_encode($expected_output));
//
//$obj->submissions($_POST['source'], base64_encode("2\n3"), base64_encode(5));
