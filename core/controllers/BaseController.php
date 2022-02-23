<?php
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
abstract class BaseController
{
	
    public static function render($xApp,$xController,$xJavascriptFile,$xPhpFile)
    {
        ?>
          <script>
               var app = angular.module('<?=$xApp?>',[]);
               app.controller('<?=$xController?>',
                    function ($scope,$http)
                    {	
            	        $http.post("<?=$xPhpFile?>",{}).success(
                    	     function(response) 
                    	     {
                       	       // $scope.names = response.records;
                         	   //escribir lo que alla que escribir de respuesta aca;
                       	     }
                       	     );
              	    }
              	);
          </script>
        <?
    }
}
?>