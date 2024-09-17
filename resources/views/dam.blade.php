<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<style>
    .important { font-weight: bold; font-size: xx-large; }
    .blue { color: blue; }
</style>
<script>
    $(document).ready(function(){
        $("#btn1").click(function(){
            $("#test1").text("Hello world!");
        });
        $("#btn2").click(function(){
            $("#test2").html("<b>Hello world!</b>");
        });
        $("#btn3").click(function(){
            $("#test3").val("Dolly Duck");
        });
        $("#btn4").click(function(){ 
            $("h1, h2, p").addClass("blue");
        });
    });
</script>

<h1>Heading 1</h1>
<h2>Heading 2</h2>
<p id="test1">This is a paragraph.</p>
<p id="test2">This is another paragraph.</p> 
<p>Input field: <input type="text" id="test3" value="Mickey Mouse"></p>

<button id="btn1">Set Text</button>
<button id="btn2">Set HTML</button>
<button id="btn3">Set Value</button>
<button id="btn4">Add classes to elements</button>

</body>
</html>