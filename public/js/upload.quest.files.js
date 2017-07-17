
    if ( $( "div#submission_upload" ).length ) {
        var submission_upload = new Dropzone('div#submission_upload',
            {url:'/dropzone/uploadFiles',
            method: "post"
            });

        submission_upload.on('sending', function(file, xhr, formData){
                var tok = $('input[name="_token"]').val();
                console.log("Appending Token " + tok)
                formData.append('_token', tok);
            });

        submission_upload.on("successmultiple", function(event, response) {
            console.log("MULTIPLE");
            something_uploaded = true;

            for (var i = 0, len = response.files.length; i < len; i++) {
                $('<input>').attr({
                    type: 'hidden',
                    id: 'files',
                    value: response.files[i].id,
                    name: 'files[]'
                }).appendTo('form');
            }

        });

        submission_upload.on("success", function(event, response) {
            something_uploaded = true;
            for (var i = 0, len = response.files.length; i < len; i++) {
                $('<input>').attr({
                    type: 'number',
                    id: 'file' + i,
                    value: parseInt(response.files[i].id),
                    name: 'files[]',
                    style: 'display:none;'
                }).appendTo('form');
            }

        });
    }    















    var uf = $("#upload-quest");
    Dropzone.autoDiscover = false;
    var quest_upload = new Dropzone('#submission_upload',
        {url:'/dropzone/uploadFiles',
        method: "post"
        });

    quest_upload.on('sending', function(file, xhr, formData){
            var tok = $('input[name="_token"]').val();
            console.log("Appending Token " + tok)
            formData.append('_token', tok);
        });

    quest_upload.on("successmultiple", function(event, response) {
        console.log("MULTIPLE");
        $("#no_attached_files").hide();
        for (var i = 0, len = response.files.length; i < len; i++) {

            var htmlToAppend = "<article class='media'><div class='media-content'><div class='content'><p>";
                htmlToAppend += response.files[i].original_name;
                htmlToAppend += "</p></div></div><div class='media-right'><a class='delete' href='";
                htmlToAppend += "/file/remove/" + response.files[i].id;
                htmlToAppend += "'></a></div></article>";
            $("#attached_files").append(htmlToAppend);
            $('<input>').attr({
                type: 'hidden',
                id: 'files',
                value: response.files[i].id,
                name: 'files[]'
            }).appendTo(uf);
        };

    });

    quest_upload.on("success", function(event, response) {
        $("#no_attached_files").hide();
        for (var i = 0, len = response.files.length; i < len; i++) {
            $('<input>').attr({
                type: 'number',
                id: 'file' + i,
                value: parseInt(response.files[i].id),
                name: 'files[]',
                style: 'display:none;'
            }).appendTo(uf);
            var htmlToAppend = "<article class='media'><div class='media-content'><div class='content'><p>";
                htmlToAppend += response.files[i].original_name;
                htmlToAppend += "</p></div></div><div class='media-right'><a class='delete' href='";
                htmlToAppend += "/file/remove/" + response.files[i].id;
                htmlToAppend += "'></a></div></article>";
            $("#attached_files").append(htmlToAppend);
        }

    });
