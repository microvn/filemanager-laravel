<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>elFinder 2.0</title>

    <!-- jQuery and jQuery UI (REQUIRED) -->
    <link rel="stylesheet" type="text/css"
          href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/themes/smoothness/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="<?= asset($dir . '/css/elfinder.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset($dir . '/css/theme.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset($dir . '/themes/Material/css/theme.css') ?>">

    <!-- elFinder JS (REQUIRED) -->
    <script src="<?= asset($dir . '/js/elfinder.full.js') ?>"></script>

    <?php if ($locale) { ?>
        <!-- elFinder translation (OPTIONAL) -->
        <script src="<?= asset($dir . "/js/i18n/elfinder.$locale.js") ?>"></script>
    <?php } ?>
    <!-- Include jQuery, jQuery UI, elFinder (REQUIRED) -->

    <script type="text/javascript">
        $().ready(function () {
            var elf = $('#elfinder').elfinder({
                // set your elFinder options here
                <?php if($locale){ ?>
                lang: '<?= $locale ?>', // locale
                <?php } ?>
                url: '<?= route("elfinder.connector") ?>',  // connector URL
                soundPath: '<?= asset($dir . '/sounds') ?>',
                rememberLastDir: true,
                dialog: {width: 900, modal: true, title: 'Select a file'},
                height: $(window).height() - 20,
                resizable: false,
                sort: 'kindDirsFirst',
                sortDirect: 'desc',
                commandsOptions: {
                    getfile: {
                        oncomplete: 'destroy'
                    }
                },
                cssAutoLoad: false,
                getFileCallback: function (file) {
                    var arrayUrl = window.location.href.split("/");
                    var input = ''
                    if (arrayUrl[5]) {
                        input = arrayUrl[5].split('#')[0];
                        if(input) input = input.split('?')[0];
                        if (input) window.parent.postMessage({input: input, file: file}, "*");
                    }
                }
            }).elfinder('instance');
        });
    </script>


</head>
<body>
<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

</body>
</html>
