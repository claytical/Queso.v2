    var qf = $("#quest-create-form");

    Dropzone.autoDiscover = false;
    var quest_upload = new Dropzone('div#quest_uploads',
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

        for (var i = 0, len = response.files.length; i < len; i++) {
            $('<input>').attr({
                type: 'hidden',
                id: 'files',
                value: response.files[i].id,
                name: 'files[]'
            }).appendTo(qf);
        }

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
            }).appendTo(qf);
            var htmlToAppend = "<article class='media'><div class='media-content'><div class='content'><p>";
                htmlToAppend += response.files[i].original_name;
                htmlToAppend += "</p></div></div><div class='media-right'><a class='delete' href='";
                htmlToAppend += "/file/remove/" + response.files[i].id;
                htmlToAppend += "'></a></div></article>";
            $("#attached_files").append(htmlToAppend);
        }

    });
