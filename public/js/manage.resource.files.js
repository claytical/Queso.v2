    var rf = $("#resource-form");
    Dropzone.autoDiscover = false;
    var resource_upload = new Dropzone('div#resource_uploads',
        {url:'/dropzone/uploadFiles',
        method: "post"
        });

    resource_upload.on('sending', function(file, xhr, formData){
            var tok = $('input[name="_token"]').val();
            console.log("Appending Token " + tok)
            formData.append('_token', tok);
        });

    resource_upload.on("successmultiple", function(event, response) {
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
            }).appendTo(rf);
        };

    });

    resource_upload.on("success", function(event, response) {
        $("#no_attached_files").hide();
        for (var i = 0, len = response.files.length; i < len; i++) {
            $('<input>').attr({
                type: 'number',
                id: 'file' + i,
                value: parseInt(response.files[i].id),
                name: 'files[]',
                style: 'display:none;'
            }).appendTo(rf);
            var htmlToAppend = "<article class='media'><div class='media-content'><div class='content'><p>";
                htmlToAppend += response.files[i].original_name;
                htmlToAppend += "</p></div></div><div class='media-right'><a class='delete' href='";
                htmlToAppend += "/file/remove/" + response.files[i].id;
                htmlToAppend += "'></a></div></article>";
            $("#attached_files").append(htmlToAppend);
        }

    });
