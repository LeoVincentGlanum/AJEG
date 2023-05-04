<body>
<div id="dartboard" class="self-center" style="width: 800px; height: 800px;"></div>

<script src="https://unpkg.com/dartboard/dist/dartboard.js"></script>
<script>
    var dartboard = new Dartboard('#dartboard');
    dartboard.render();

    document.querySelector('#dartboard').addEventListener('throw', function(d) {
        console.log(d.detail);
    });
</script>
</body>
