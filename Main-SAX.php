<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Start för SAX</title>
   
    </head>
    <body>

        <form method="POST" action="Receive-SAX.php">
        
        <select name='NEWSPAPER'>

        <?php
            
            $url="http://wwwlab.webug.se/examples/XML/articleservice/papers/";
            $Datta = file_get_contents($url);

            
            function starttagg($parser, $EntName, $Atribut) {
                
                if($EntName == 'NEWSPAPER'){
                    echo "<option value='".$Atribut['TYPE']."'>";
                    echo $Atribut['NAME'];
                }
            }
            
            function sluttagg($parser, $EntName) {
                
                if($EntName=='NEWSPAPER'){
                    echo"</option>";

                }
            }
            
            function charData($parser, $chardata) {

            }
            
            $parser = xml_parser_create();
            
            xml_set_element_handler($parser, "starttagg", "sluttagg");
            xml_set_character_data_handler($parser, "charData");
            

            
            

            
            
            if(!xml_parse($parser, $Datta, true)){
                printf("<P> Error %s at line %d</P>", xml_error_string(xml_get_error_code($parser)),xml_get_current_line_number($parser));
            }else{
                "<br>Parsing Complete!</br>";
            }
            
            xml_parser_free($parser);

        ?>

        </select>
        <input type="submit" name="Skickadata" value="Skicka!">
        </form>

        
    </body>
</html>

