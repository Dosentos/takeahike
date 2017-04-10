<?php
/**
 * Created by PhpStorm.
 * User: Dosentti
 * Date: 10.4.2017
 * Time: 16.12
 */
?>

<main>
    <h3>This is content</h3>
    <div id="test-div"></div>
    <script type="text/babel">

        //Tämä toimii
        ReactDOM.render(
                <h1>Hello, world!</h1>,
            document.getElementById('test-div')
        );
    </script>
    //Miksi alla oleva ei toimi?
    <script src="js/test.js"></script>
</main>

