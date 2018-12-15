<?php
/**
 * Plugin Name:       Submit Code
 * Description:       Submit your code (I'm Tester)
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
if (!defined('CODE_SUBMIT_URL'))
    define('FEEDIER_URL', plugin_dir_url(__FILE__));
if (!defined('CODE_SUBMIT_PATH'))
    define('FEEDIER_PATH', plugin_dir_path(__FILE__));

class Submit
{

    private $test_case_array = [];
    private $lang_id = ['C (gcc 7.2.0)' => 4, 'C++ (g++ 7.2.0)' => 10, 'Java (JDK 9)' => 26, 'Go (1.9)' => 22, 'Python (3.6.0)' => 34];

    function addFilter()
    {
        add_filter('the_content', function ($content) {
            // init post, length
            $pos_start = 0;
            $pos_end = mb_strpos($content, 'start-test');
            $pos_last = mb_strpos($content, 'end-test');
            $content_length = mb_strlen($content);
            $test_length = mb_strlen(mb_substr($content, $pos_end));

            if ($pos_end == false || $pos_last == false) {
                return $content;
            }

            if (is_single()) {
                require 'style.php';
                $new_content = "";
                // test case string
                $test_case = mb_substr($content, $pos_end + strlen('start-test'), $content_length - strlen(' end-test'));
                //echo $test_case;
                $test_case = str_split($test_case);
                $line = (string)'';
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
                        if ($input != '' && $output != '') {
                            //echo '<br>' . $input . ' : ' . $output;
                            //echo '<br>' . $line;
                            $this->test_case_array[] = new TestCase($input, $output);
                        }
                        $line = '';
                    }
                }
                // content string without test case
                $content = mb_substr($content, $pos_start, $content_length - $test_length);
                $new_content .= $content;
                if (is_user_logged_in()) {

                    return $new_content;
                } else {
                    return $new_content;
                }
            } else {
                $content = mb_substr($content, $pos_start, $content_length - $test_length);
                return $content;
            }
        }, 0);

    }

    function addFilter2()
    {
        add_filter('the_content', function ($content) {

            if (empty($this->test_case_array)) {
                return $content;
            }
            echo $content;
            if (is_single() && is_user_logged_in()) {
                echo '<textarea id="code-editor" name="source" required></textarea>';
                echo '<select name="lang_id" class="lang_id">';
                foreach ($this->lang_id as $lang_name => $lang_id){
                    if ($_COOKIE['lang_id'] == $lang_id)
                        echo '<option value="'.$lang_id.'" selected>'.$lang_name.'</option>';
                    else
                        echo '<option value="'.$lang_id.'">'.$lang_name.'</option>';
                }
                echo '</select>';
                echo '<button onclick="submit_code()" class="submit-code-btn">Submit</button>';
                echo '<p></p>';
                echo '<div class="submit-result"></div>';

                echo '<script>
                            var clicked = 0;
                            var input = new Array();
                            var output = new Array();
                        </script>';

                foreach ($this->test_case_array as $value) {
                    echo '<script> input.push("' . $value->input . '") </script>';
                    echo '<script> output.push("' . $value->output . '") </script>';
                }

                echo '<script>
                    var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
                                            lineNumbers: true,
                                            theme: "material"
                                          });
                    
                    function b64DecodeUnicode(str) {
                        return decodeURIComponent(atob(str).split(\'\').map(function(c) {
                                return \'%\' + (\'00\' + c.charCodeAt(0).toString(16)).slice(-2);
                            }).join(\'\'));
                    }
                    
                    async function submit_code() {
                        var source_code = myCodeMirror.getValue()
                        if (source_code != "")
                            clicked++;
                        var count_unit_test = 1;
                        var total = input.length;
                        var pass = 0;
                        var err = 0;
                        await $(".submit-code-btn").css("color: while")
                        await $(".submit-code-btn").prop("", "wait...")
                        var lang_id = await $(".lang_id").find(":selected").val();
                        
                        if (clicked === 1) {
                            await $( ".submit-result" ).empty();
                            if (source_code != ""){
                                for (var i=0; i< input.length; i++){
                                    if (err === 1){
                                        break;
                                    }
                                    await $.ajax({
                                              method: "POST",
                                              url: "' . get_site_url() . '/wp-content/plugins/submit-code/api.php",
                                              data: {
                                                  source: source_code,
                                                  stdin: input[i],
                                                  expected_output:  output[i],
                                                  lang_id: lang_id
                                               }
                                            })
                                          .done(async function(data) {
                                              var json = JSON.stringify(data);
                                              var dataJson = JSON.parse(json);
                                              var description = dataJson.status.description;
                                              var your_ouput = atob(dataJson.stdout);
                                              var expected_output = output[i];
                                              console.log(dataJson);
                                              if (description !== "Accepted" && description !== "Wrong Answer"){
                                                  err = 1;
                                                  await $(".submit-result").append("<p class=wrong>"+ description +"</p>");
                                              }                                 
                                                  
                                              if (description === "Accepted") {
                                                  pass++;
                                                  await $(".submit-result").append("<p class=accepted>"+count_unit_test+". "+ description +"</p>");                                                                              
                                              } else {                                               
                                                  if (description === "Compilation Error"){
                                                    var complite_output = b64DecodeUnicode(dataJson.compile_output);
                                                    await $(".submit-result").append("<p class=compilation_error>"+complite_output +"</p>");
                                                  } 
                                                  if (description === "Wrong Answer"){
                                                    await $(".submit-result").append("<p class=wrong>"+count_unit_test+". "+ description +"</p>");
                                                    await $(".submit-result").append("<p class=wrong_detail> Test: "+input[i] +"</p>");
                                                    await $(".submit-result").append("<p class=wrong_detail> Expected Output: "+expected_output +"</p>");
                                                    await $(".submit-result").append("<p class=wrong_detail> Your Output: "+your_ouput +"</p>");
                                                  } 
                                              }
                                          })
                                          .fail(function(jqXHR, textStatus, errorThrown) {
                                              alert("Lỗi");
                                              err = 1;
                                              clicked = 0;
                                          });
                                    count_unit_test++;
                                }
                                await $(".submit-result").append("<br><br>");
                                if (pass < total/2)
                                    await $(".submit-result").append("<h4 class=Wrong> Passed: "+pass+"/"+total+"</h4>");
                                else
                                    await $(".submit-result").append("<h4 class=accepted> Passed: "+pass+"/"+total+"</h4>");
                                
                                clicked = 0;
                            }
                        }
                    }
              </script>';
            } else{
                return '';
            }
        });
    }

}

class TestCase
{
    public $input;
    public $output;

    function __construct($input, $output)
    {
        $this->input = $input;
        $this->output = $output;
    }
}

$obj = new Submit();
$obj->addFilter();
$obj->addFilter2();