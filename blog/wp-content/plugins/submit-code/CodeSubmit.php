<?php
/**
 * Plugin Name:       Submit Code
 * Description:       Submit your code (Tester)
 * Version:           1.0.0
 * Author:            IndieTeam
 * Author URI:
 * Text Domain:
 * License:
 * License URI:
 * GitHub Plugin URI:
 */

/*
 * Plugin constants
 */
if(!defined('CODE_SUBMIT_URL'))
    define('FEEDIER_URL', plugin_dir_url( __FILE__ ));
if(!defined('CODE_SUBMIT_PATH'))
    define('FEEDIER_PATH', plugin_dir_path( __FILE__ ));

add_filter( 'the_content', function ($content){
    // init post, length
    if (is_single()) {
        $pos_start = 0;
        $pos_end = mb_strpos($content, 'start-test');
        $pos_last =  mb_strpos($content, 'end-test');
        $content_length = strlen($content);

        if ($pos_end == false || $pos_last == false){
            return $content;
        }

        // test case string
        $test_case = mb_substr($content, $pos_end + strlen('start-test'), $content_length - strlen(' end-test'));
        //echo $test_case;
        $test_case = str_split($test_case);
        $line = (string)'';
        $test_case_array = [];
        foreach ($test_case as $char) {
            if ($char != ';') {
                $line .= (string)$char;
            }
            if ($char == ';') {
                $line .= ';';
                $line = trim($line);
                $pos_input = mb_strpos($line, 'input:');
                $pos_output = mb_strpos($line, 'output:');
                $input = mb_substr($line, $pos_input + strlen('input:') + 1, $pos_output - strlen('output:') - 1);
                $output = mb_substr($line, $pos_output + strlen('output:') + 1, strlen($line) - strlen($input) - strlen('output:') - strlen('input:') - 5);
                //echo '<br>'.$input.' : '.$output;
                $line = '';
                $test_case_array[] = new TestCase($input, $output);
            }
        }
        // content string without test case
        $content = mb_substr($content, $pos_start, $pos_end);
        echo '<br>';
        echo '
                
                <link rel="stylesheet" href="../../../../wp-content/plugins/submit-code/assets/code-editor/theme/material.css">
               <link rel="stylesheet" href="../../../../wp-content/plugins/submit-code/assets/code-editor/lib/codemirror.css">
                <script src="../../../../wp-content/plugins/submit-code/assets/code-editor/lib/codemirror.js"></script>
                <script src="../../../../wp-content/plugins/submit-code/assets/code-editor/mode/javascript/javascript.js"></script>
            ';
        echo $content;
        if (is_user_logged_in()) {
            echo '<br>';
            echo '<style>
                .CodeMirror{
                border: 3px solid #263238;
                    border-radius: 10px;
                }
                .submit-code-btn{
                    background: #263238;
                    color: white;
                    width: 80px;
                    height: 40px;
                    text-align: center;
                    border-radius: 10px;
                    margin-top: 20px;
                }
                .submit-code-btn:
              </style>';
            echo '<textarea id="code-editor" name="source" required></textarea>';
            echo '<button onclick="submit_code()" class="submit-code-btn">Submit</button>';
            echo '<script>
                    var input = new Array();
                    var output = new Array();
                    </script>';
            foreach ($test_case_array as $value){
                echo '<script> input.push(String.raw`'.$value->input.'`) </script>';
                echo '<script> output.push(String.raw`'.$value->output.'`) </script>';
            }
            echo '<script>
                    var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
                                            lineNumbers: true,
                                             theme: "material"
                                          });
                    function submit_code() {
                        document.getElementsByClassName("submit-code-btn")[0].style.color = "white";
                        for (var i=0; i< input.length; i++){
                            console.log("input: " + String.raw`${input[i]}` + "  output: " + String.raw`${output[i]}`)
                        } 
                        alert(myCodeMirror.getValue());
                    }
              </script>';
        }
        return '';
    }
}, 0);


class TestCase{
    public $input;
    public  $output;

    function __construct($input, $output)
    {
        $this->input = $input;
        $this->output = $output;
    }
}