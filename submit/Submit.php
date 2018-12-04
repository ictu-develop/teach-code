<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test api</title>
    <style>
        body{
            font-family: sans-serif;
        }
    </style>
</head>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/18
 * Time: 2:23 PM
 */
//header('Content-Type: application/json; charset=UTF-8');

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

    function submissions($source_code, $stdin, $expected_output, $index)
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
        //$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $obj = json_decode($res);

        if ($obj->status->description === 'Accepted')
            echo '<p style="color:green;"> Test '.$index.': '.$obj->status->description.'<br></p>';
        else
            echo '<p style="color:red;"> Test '.$index.': '.$obj->status->description.'<br></p>';

        echo 'Input: '.base64_decode($stdin).'<br>';
        echo 'Expected output: '.base64_decode($expected_output).'<br>';
        echo 'Your ouput: '.base64_decode($obj->stdout).'<br>';
        if ($obj->compile_output != null)
            echo 'Messenge: '.base64_decode($obj->compile_output);
    }

}

$obj = new Submit();
//$obj->authenticate();
//echo '<br>';
//
//$obj->authorize();
//echo '<br>';

$obj->submissions($_POST['source'], base64_encode("2\n3"), base64_encode(5), 1);
echo '<br><br>';

$obj->submissions($_POST['source'], base64_encode("100\n100"), base64_encode(200), 2);
echo '<br><br>';


$obj->submissions($_POST['source'], base64_encode("60\n40"), base64_encode(100), 3);
echo '<br><br>';

$obj->submissions($_POST['source'], base64_encode("100\n50"), base64_encode(150), 4);
echo '<br><br>';


$obj->submissions($_POST['source'], base64_encode("7\n50"), base64_encode(57), 5);
echo '<br><br>';



