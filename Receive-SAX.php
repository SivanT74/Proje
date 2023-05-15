<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tar emot SAX</title>


        <Style>
            #Reviews{
                background: #03fcfc;
                padding: 2px;
                box-shadow: 7px 5px 5px black;
            }

            #News{
                background: #d203fc;
                padding: 2px;
                box-shadow: 7px 5px 5px black;
            }
        </Style>

    </head>
    <body>
        
        <table border='2'>
        <?php
            $url="http://wwwlab.webug.se/examples/XML/articleservice/papers/";
            $Datta = file_get_contents($url);
            $lastelement="";  
            
            function starttagg($parser, $EntName, $Atribut) {
                
                global $lastelement; 
                
                if($EntName == 'NEWSPAPER'){
                    
                    echo "<tr>";
                    echo "<td>". $Atribut['NAME']."</td>";
                    echo "<td>". $Atribut['SUBSCRIBERS']."</td>";
                    echo "<td>". $Atribut['TYPE']."</td>";
                    echo "<td><table>";

                }
               
                if($EntName == 'ARTICLE'){
                    
                    echo "<tr>";
                    echo "<td>". $Atribut['ID']."</td>";
                    echo "<td>". $Atribut['TIME']."</td>";
                    
                    if($Atribut['DESCRIPTION'] == "Review"){
                            echo "<td id='Reviews'>
                            <table>";
                    }else{
                            echo "<td id='News'>
                            <table>";

                    };
                    
                }
                
                if($EntName == 'HEADING'){
                    
                    echo "<h3>";
                }
                
                if($EntName == 'STORY'){
            
                    echo "<div>";
                }
                
                if($EntName == 'TEXT'){
            
                    echo "<p>";
                }
                
                if($EntName!="TEXT") $lastelement=$EntName;     
                
            }
            
            function sluttagg($parser, $EntName) {
                
                if($EntName=='NEWSPAPER'){
                        echo "</table></td>";
                        echo "</tr>";
                }
                
                if($EntName=='ARTICLE'){
                    echo "</table></td>";
                    echo "</tr>";
                }
                
                if($EntName == 'HEADING'){
                    echo "</h3>";
                }
                
                if($EntName == 'TEXT'){
                    echo "</p>";
                }
                
                if($EntName == 'TEXT'){
                    echo "</div>";
                }       
                
            }
            
            
            function charData($parser, $chardata) {
                
                global $lastelement;
                $chardata=trim($chardata);
                
                if($chardata=="") return;
                echo $chardata;
            }
            
            $parser = xml_parser_create();
            xml_set_element_handler($parser, "starttagg", "sluttagg");
            xml_set_character_data_handler($parser, "charData");

            if(isset($_POST['NEWSPAPER'])){
                $NEWSPAPER=$_POST['NEWSPAPER'];
            }else{
                $NEWSPAPER="Unknown";
            }
            
            $url="http://193.93.251.189/examples/XML/articleservice/articles/?paper=".$_POST['NEWSPAPER'];
            $Datta = file_get_contents($url);
            
            if(!xml_parse($parser, $Datta, true)){
                printf("<P> Error %s at line %d</P>", xml_error_string(xml_get_error_code($parser)),xml_get_current_line_number($parser));
            }else{

            }
            
            xml_parser_free($parser);
    

        ?>
        </table>
    </body>
</html>